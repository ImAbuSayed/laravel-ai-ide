<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LaravelProject;

class ProjectCreate extends Component
{
    public $name = '';
    public $description = '';
    public $use_authentication = false;
    public $use_api = false;
    public $use_admin_panel = false;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'use_authentication' => 'boolean',
        'use_api' => 'boolean',
        'use_admin_panel' => 'boolean',
    ];

    public function createProject()
    {
        $this->validate();

        $project = LaravelProject::create([
            'name' => $this->name,
            'description' => $this->description,
            'use_authentication' => $this->use_authentication,
            'use_api' => $this->use_api,
            'use_admin_panel' => $this->use_admin_panel,
        ]);

        session()->flash('message', 'Project created successfully.');

        return redirect()->route('project.view', $project);
    }

    public function render()
    {
        return view('livewire.project-create')
            ->layout('components.layouts.app');
    }
}
