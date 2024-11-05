<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display a listing of the tasks
    public function index(Request $request)
    {
        // Get all tasks with pagination
        $tasks = Task::paginate(10);
        
        // Get task counts for the chart
        $pendingCount = Task::where('status', 'pending')->count();
        $inProgressCount = Task::where('status', 'in_progress')->count();
        $completedCount = Task::where('status', 'completed')->count();
        
        // Return the index view with the tasks and the counts
        return view('tasks.index', compact('tasks', 'pendingCount', 'inProgressCount', 'completedCount'));
    }

    // Show the form for creating a new task
    public function create()
    {
        return view('tasks.create');
    }

    // Store a newly created task in storage
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);

        // Create the task
        Task::create($request->all());

        // Redirect to the task index with a success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Display the specified task
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // Show the form for editing the specified task
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Update the specified task in storage
    public function update(Request $request, Task $task)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);

        // Update the task
        $task->update($request->all());

        // Redirect to the task index with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Remove the specified task from storage
    public function destroy(Task $task)
    {
        $task->delete();

        // Redirect to the task index with a success message
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    // Filter tasks by status
    public function filter($status)
    {
        // Retrieve the tasks with the specified status
        $tasks = Task::where('status', $status)->paginate(10);

        // Get task counts for the chart
        $pendingCount = Task::where('status', 'pending')->count();
        $inProgressCount = Task::where('status', 'in_progress')->count();
        $completedCount = Task::where('status', 'completed')->count();

        // Pass tasks and counts to the view
        return view('tasks.index', compact('tasks', 'pendingCount', 'inProgressCount', 'completedCount'));
    }

    // Search tasks by title
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $tasks = Task::where('title', 'LIKE', "%{$searchTerm}%")->paginate(10);
        
        // Get task counts for the chart
        $pendingCount = Task::where('status', 'pending')->count();
        $inProgressCount = Task::where('status', 'in_progress')->count();
        $completedCount = Task::where('status', 'completed')->count();
        
        return view('tasks.index', compact('tasks', 'pendingCount', 'inProgressCount', 'completedCount'));
    }
}
