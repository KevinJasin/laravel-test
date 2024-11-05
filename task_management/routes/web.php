<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Route for the home page that redirects to the tasks index
Route::get('/', function () {
    return redirect()->route('tasks.index'); // Redirect to the task index page
});

// Resource routes for Task management
Route::resource('tasks', TaskController::class);

// Route to filter tasks by status
Route::get('/tasks/filter/{status}', [TaskController::class, 'filter'])->name('tasks.filter');

// Route to search tasks by title
Route::get('/tasks/search', [TaskController::class, 'search'])->name('tasks.search');
