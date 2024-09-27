<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\ProjectCreate;
use App\Livewire\ProjectView;
use App\Livewire\ProjectList;
use App\Livewire\ProjectCreateWizard;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/projects', ProjectList::class)->name('project.list');
Route::get('/project/create', ProjectCreate::class)->name('project.create');
Route::get('/project/create-wizard', ProjectCreateWizard::class)->name('project.create.wizard');
Route::get('/project/{laravelProject}', ProjectView::class)->name('project.view');
