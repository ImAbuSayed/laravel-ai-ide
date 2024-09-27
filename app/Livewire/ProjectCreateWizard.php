<?php

namespace App\Livewire;

use App\Models\LaravelProject;
use App\Models\LaravelPrompt;
use Livewire\Component;
use OpenAI;

class ProjectCreateWizard extends Component
{
    public $step = 1;

    public $totalSteps = 7;

    public $name = '';

    public $description = '';

    public $features = [];

    public $use_authentication = false;

    public $use_api = false;

    public $use_admin_panel = false;

    public $database_design = '';

    public $models = [];

    public $migrations = [];

    public $controllers = [];

    public $views = [];

    public $factories = [];

    public $seeders = [];

    public $mails = [];

    public $notifications = [];

    public $aiPrompt = '';

    public $selectedPrompt = '';

    public $preBuiltPrompts = [];

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'required|max:1000',
        'database_design' => 'required',
    ];

    public function mount()
    {
        $this->preBuiltPrompts = LaravelPrompt::all();
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'name' => 'required|min:3|max:255',
                'description' => 'required|max:1000',
            ]);
        }
        if ($this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function createProject()
    {
        $this->validate();

        $project = LaravelProject::create([
            'name' => $this->name,
            'description' => $this->description,
            'use_authentication' => $this->use_authentication,
            'use_api' => $this->use_api,
            'use_admin_panel' => $this->use_admin_panel,
            'database_design' => $this->database_design,
            'features' => $this->features,
        ]);

        $this->createRelatedEntities($project);

        session()->flash('message', 'Project created successfully.');

        return redirect()->route('project.view', $project);
    }

    private function createRelatedEntities($project)
    {
        $this->createModels($project);
        $this->createMigrations($project);
        $this->createControllers($project);
        $this->createViews($project);
        $this->createFactories($project);
        $this->createSeeders($project);
        $this->createRules($project);
        $this->createMails($project);
        $this->createNotifications($project);
    }

    private function createModels($project)
    {
        foreach ($this->models as $model) {
            $project->models()->create($model);
        }
    }

    private function createMigrations($project)
    {
        foreach ($this->migrations as $migration) {
            $project->migrations()->create($migration);
        }
    }

    private function createControllers($project)
    {
        foreach ($this->controllers as $controller) {
            $project->controllers()->create($controller);
        }
    }

    private function createViews($project)
    {
        foreach ($this->views as $view) {
            $project->views()->create($view);
        }
    }

    private function createFactories($project)
    {
        foreach ($this->factories as $factory) {
            $project->factories()->create($factory);
        }
    }

    private function createSeeders($project)
    {
        foreach ($this->seeders as $seeder) {
            $project->seeders()->create($seeder);
        }
    }

    private function createRules($project)
    {
        foreach ($this->rules as $rule) {
            $project->rules()->create($rule);
        }
    }

    private function createMails($project)
    {
        foreach ($this->mails as $mail) {
            $project->mails()->create($mail);
        }
    }

    private function createNotifications($project)
    {
        foreach ($this->notifications as $notification) {
            $project->notifications()->create($notification);
        }
    }

    public function improveWithAI($field)
    {
        $prompt = "Improve the following {$field} for a Laravel project: {$this->$field}";
        $response = $this->getAIResponse($prompt);
        $this->$field = $response;
    }

    public function generateFeaturesWithAI()
    {
        $prompt = "Generate a list of features for a Laravel project with the following description: {$this->description}";
        $response = $this->getAIResponse($prompt);
        $this->features = explode("\n", $response);
    }

    public function generateWithAI()
    {
        $prompt = $this->buildPrompt();
        $response = $this->getAIResponse($prompt);
        $this->processAIResponse($response);
    }

    private function buildPrompt()
    {
        $promptText = "Project Name: {$this->name}\n";
        $promptText .= "Description: {$this->description}\n";
        $promptText .= 'Features: '.implode(', ', $this->features)."\n";
        $promptText .= "Database Design: {$this->database_design}\n";
        $promptText .= 'Use Authentication: '.($this->use_authentication ? 'Yes' : 'No')."\n";
        $promptText .= 'Use API: '.($this->use_api ? 'Yes' : 'No')."\n";
        $promptText .= 'Use Admin Panel: '.($this->use_admin_panel ? 'Yes' : 'No')."\n";
        $promptText .= "Additional Instructions: {$this->aiPrompt}\n\n";

        switch ($this->step) {
            case 3:
                $promptText .= 'Generate Laravel models based on the database design.';
                break;
            case 4:
                $promptText .= 'Generate Laravel migrations based on the models and database design.';
                break;
            case 5:
                $promptText .= 'Generate Laravel controllers for the models.';
                break;
            case 6:
                $promptText .= 'Generate Laravel views for the models.';
                break;
            case 7:
                $promptText .= 'Generate Laravel factories, seeders, and rules for the models.';
                break;
        }

        return $promptText;
    }

    private function getAIResponse($prompt)
    {
        $yourApiKey = getenv('OPENAI_API_KEY');
        $client = OpenAI::client($yourApiKey);

        try {
            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant that generates Laravel code.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            return $response->choices[0]->message->content;
        } catch (\Exception $e) {
            return 'Error: '.$e->getMessage();
        }
    }

    private function processAIResponse($response)
    {
        switch ($this->step) {
            case 3:
                $this->processModels($response);
                break;
            case 4:
                $this->processMigrations($response);
                break;
            case 5:
                $this->processControllers($response);
                break;
            case 6:
                $this->processViews($response);
                break;
            case 7:
                $this->processFactoriesSeedersRules($response);
                break;
        }
    }

    private function processModels($response)
    {
        $models = explode('###MODEL###', $response);
        foreach ($models as $model) {
            if (empty(trim($model))) {
                continue;
            }

            preg_match('/class\s+(\w+)/', $model, $matches);
            $modelName = $matches[1] ?? 'UnnamedModel';

            $this->models[] = [
                'name' => $modelName,
                'content' => trim($model),
            ];
        }
    }

    private function processMigrations($response)
    {
        $migrations = explode('###MIGRATION###', $response);
        foreach ($migrations as $migration) {
            if (empty(trim($migration))) {
                continue;
            }

            preg_match('/class\s+(\w+)/', $migration, $matches);
            $migrationName = $matches[1] ?? 'UnnamedMigration';

            $this->migrations[] = [
                'name' => $migrationName,
                'content' => trim($migration),
            ];
        }
    }

    private function processControllers($response)
    {
        $controllers = explode('###CONTROLLER###', $response);
        foreach ($controllers as $controller) {
            if (empty(trim($controller))) {
                continue;
            }

            preg_match('/class\s+(\w+)/', $controller, $matches);
            $controllerName = $matches[1] ?? 'UnnamedController';

            $this->controllers[] = [
                'name' => $controllerName,
                'content' => trim($controller),
            ];
        }
    }

    private function processViews($response)
    {
        $views = explode('###VIEW###', $response);
        foreach ($views as $view) {
            if (empty(trim($view))) {
                continue;
            }

            preg_match('/<!-- View: ([\w\.]+) -->/', $view, $matches);
            $viewName = $matches[1] ?? 'unnamed.blade.php';

            $this->views[] = [
                'name' => $viewName,
                'content' => trim($view),
            ];
        }
    }

    private function processFactoriesSeedersRules($response)
    {
        $parts = explode('###', $response);
        foreach ($parts as $part) {
            if (empty(trim($part))) {
                continue;
            }

            if (strpos($part, 'FACTORY') === 0) {
                $this->processFactory(substr($part, 8));
            } elseif (strpos($part, 'SEEDER') === 0) {
                $this->processSeeder(substr($part, 7));
            } elseif (strpos($part, 'RULE') === 0) {
                $this->processRule(substr($part, 5));
            }
        }
    }

    private function processFactory($factory)
    {
        preg_match('/class\s+(\w+)/', $factory, $matches);
        $factoryName = $matches[1] ?? 'UnnamedFactory';

        $this->factories[] = [
            'name' => $factoryName,
            'content' => trim($factory),
        ];
    }

    private function processSeeder($seeder)
    {
        preg_match('/class\s+(\w+)/', $seeder, $matches);
        $seederName = $matches[1] ?? 'UnnamedSeeder';

        $this->seeders[] = [
            'name' => $seederName,
            'content' => trim($seeder),
        ];
    }

    private function processRule($rule)
    {
        preg_match('/class\s+(\w+)/', $rule, $matches);
        $ruleName = $matches[1] ?? 'UnnamedRule';

        $this->rules[] = [
            'name' => $ruleName,
            'content' => trim($rule),
        ];
    }

    public function addFeature()
    {
        $this->features[] = '';
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function addModel()
    {
        $this->models[] = ['name' => '', 'content' => ''];
    }

    public function removeModel($index)
    {
        unset($this->models[$index]);
        $this->models = array_values($this->models);
    }

    public function addMigration()
    {
        $this->migrations[] = ['name' => '', 'content' => ''];
    }

    public function removeMigration($index)
    {
        unset($this->migrations[$index]);
        $this->migrations = array_values($this->migrations);
    }

    public function addController()
    {
        $this->controllers[] = ['name' => '', 'content' => ''];
    }

    public function removeController($index)
    {
        unset($this->controllers[$index]);
        $this->controllers = array_values($this->controllers);
    }

    public function addView()
    {
        $this->views[] = ['name' => '', 'content' => ''];
    }

    public function removeView($index)
    {
        unset($this->views[$index]);
        $this->views = array_values($this->views);
    }

    public function addFactory()
    {
        $this->factories[] = ['name' => '', 'content' => ''];
    }

    public function removeFactory($index)
    {
        unset($this->factories[$index]);
        $this->factories = array_values($this->factories);
    }

    public function addSeeder()
    {
        $this->seeders[] = ['name' => '', 'content' => ''];
    }

    public function removeSeeder($index)
    {
        unset($this->seeders[$index]);
        $this->seeders = array_values($this->seeders);
    }

    public function addRule()
    {
        $this->rules[] = ['name' => '', 'content' => ''];
    }

    public function removeRule($index)
    {
        unset($this->rules[$index]);
        $this->rules = array_values($this->rules);
    }

    public function render()
    {
        return view('livewire.project-create-wizard')->layout('components.layouts.app');
    }
}
