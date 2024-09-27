<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LaravelProject;

class Dashboard extends Component
{
    public $projectCount;
    public $recentProjects;

    public function mount()
    {
        $this->projectCount = LaravelProject::count();
        $this->recentProjects = LaravelProject::latest()->take(5)->get();
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('components.layouts.app');
    }
}
