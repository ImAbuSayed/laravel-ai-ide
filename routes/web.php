<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\ProjectCreate;
use App\Livewire\ProjectView;
use App\Livewire\ProjectList;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/projects', ProjectList::class)->name('project.list');
Route::get('/project/create', ProjectCreate::class)->name('project.create');
Route::get('/project/{laravelProject}', ProjectView::class)->name('project.view');
