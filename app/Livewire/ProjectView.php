<?php

namespace App\Livewire;

use App\Models\LaravelProject;
use App\Models\ProjectFile;
use League\CommonMark\CommonMarkConverter;
use Livewire\Component;
use OpenAI;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class ProjectView extends Component
{
    public LaravelProject $laravelProject;
    public $newFileName = '';
    public $newFileContent = '';
    public $aiPrompt = '';
    public $aiResponse = '';
    public $formattedAiResponse = '';
    public $folderStructure = [];

    protected $rules = [
        'newFileName' => 'required|max:255',
        'newFileContent' => 'required',
    ];

    public function mount(LaravelProject $laravelProject)
    {
        $this->laravelProject = $laravelProject;
        $this->ensureProjectDirectoryExists();
        $this->updateFolderStructure();
    }



    private function ensureProjectDirectoryExists()
    {
        $projectPath = storage_path('app/projects/' . $this->laravelProject->id);
        if (!File::exists($projectPath)) {
            File::makeDirectory($projectPath, 0755, true);
        }
    }

    private function updateFolderStructure()
    {
        $projectPath = storage_path('app/projects/' . $this->laravelProject->id);
        $this->folderStructure = $this->getFolderStructure($projectPath);
    }

    private function getFolderStructure($path)
    {
        if (!File::exists($path)) {
            return [];
        }

        $structure = [];
        $files = File::files($path);
        $directories = File::directories($path);

        foreach ($files as $file) {
            $structure[] = [
                'type' => 'file',
                'name' => $file->getFilename(),
                'path' => $file->getPathname(),
            ];
        }

        foreach ($directories as $directory) {
            $structure[] = [
                'type' => 'directory',
                'name' => basename($directory),
                'path' => $directory,
                'children' => $this->getFolderStructure($directory),
            ];
        }

        return $structure;
    }

    public function createFile()
    {
        $this->validate();

        $file = $this->laravelProject->files()->create([
            'file_path' => $this->newFileName,
            'content' => $this->newFileContent,
            'file_type' => $this->getFileType($this->newFileName),
        ]);

        $this->createFileInProject($file);

        $this->newFileName = '';
        $this->newFileContent = '';
        $this->updateFolderStructure();

        session()->flash('message', 'File created successfully.');
    }

    private function createFileInProject(ProjectFile $file)
    {
        $projectPath = 'projects/' . $this->laravelProject->id;
        Storage::put($projectPath . '/' . $file->file_path, $file->content);
    }

    public function generateCode()
    {
        $yourApiKey = getenv('OPENAI_API_KEY');
        $client = OpenAI::client($yourApiKey);

        $prompt = $this->buildPrompt();

        try {
            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant that generates Laravel code.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => 1000,
            ]);

            $this->aiResponse = $response->choices[0]->message->content;
            $this->formattedAiResponse = $this->formatCode($this->aiResponse);
        } catch (\Exception $e) {
            $this->aiResponse = 'Error: '.$e->getMessage();
            $this->formattedAiResponse = $this->formatCode($this->aiResponse);
        }
    }

    public function fillUpContent()
    {
        $this->newFileContent = $this->aiResponse;
    }

    public function viewFile($fileId)
    {
        $file = ProjectFile::findOrFail($fileId);
        $this->newFileName = $file->file_path;
        $this->newFileContent = $file->content;
    }

    public function editFile($fileId)
    {
        $file = ProjectFile::findOrFail($fileId);
        $this->newFileName = $file->file_path;
        $this->newFileContent = $file->content;
    }

    public function deleteFile($fileId)
    {
        $file = ProjectFile::findOrFail($fileId);
        Storage::delete('projects/' . $this->laravelProject->id . '/' . $file->file_path);
        $file->delete();
        $this->updateFolderStructure();
    }


    private function formatCode($markdown)
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $html = $converter->convert($markdown)->getContent();

        // Wrap code blocks with proper highlighting, preserving newlines
        $html = preg_replace('/<pre><code>(.*?)<\/code><\/pre>/s', '<pre><code class="language-php">$1</code></pre>', $html);

        // Replace newlines with <br> tags outside of <pre> blocks
        $html = preg_replace_callback('/<pre>.*?<\/pre>(*SKIP)(*F)|([^<]+)/s', function ($matches) {
            return str_replace("\n", '<br>', $matches[0]);
        }, $html);

        return $html;
    }

    private function buildPrompt()
    {
        return "Generate Laravel code for a project with the following details:
Project Name: {$this->laravelProject->name}
Description: {$this->laravelProject->description}
Uses Authentication: ".($this->laravelProject->use_authentication ? 'Yes' : 'No').'
Uses API: '.($this->laravelProject->use_api ? 'Yes' : 'No').'
Uses Admin Panel: '.($this->laravelProject->use_admin_panel ? 'Yes' : 'No')."
Additional instructions: {$this->aiPrompt}

Generate the code for the following file: {$this->newFileName}

Please provide the complete code for this file, including any necessary imports, class definitions, and methods.";
    }

    private function getFileType($fileName)
    {
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        switch ($extension) {
            case 'php':
                return 'php';
            case 'blade.php':
                return 'blade';
            case 'js':
                return 'js';
            case 'css':
                return 'css';
            case 'json':
                return 'json';
            case 'env':
                return 'env';
            default:
                return 'other';
        }
    }

    public function render()
    {
        return view('livewire.project-view', [
            'files' => $this->laravelProject->files,
        ])->layout('components.layouts.app');
    }
}
