<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LaravelProject;

class ProjectList extends Component
{
    public function render()
    {
        return view('livewire.project-list', [
            'projects' => LaravelProject::latest()->get()
        ])->layout('components.layouts.app');
    }
}
