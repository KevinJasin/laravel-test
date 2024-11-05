@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Task Management</h1>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Create Task Button --}}
    <div class="mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
    </div>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('tasks.search') }}" class="mb-3">
        <input type="text" name="search" placeholder="Search by title" class="form-control" required>
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>

    {{-- Filter Buttons --}}
    <div class="mb-3">
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">All</a>
        <a href="{{ route('tasks.filter', 'pending') }}" class="btn btn-warning">Pending</a>
        <a href="{{ route('tasks.filter', 'in_progress') }}" class="btn btn-info">In Progress</a>
        <a href="{{ route('tasks.filter', 'completed') }}" class="btn btn-success">Completed</a>
    </div>

    {{-- Task List --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination Links --}}
    <div class="mt-4">
        {{ $tasks->links() }}
    </div>

    {{-- Chart Section --}}
    <h2 class="mt-5">Task Status Overview</h2>
    <canvas id="taskStatusChart" style="max-height: 400px;"></canvas>

    {{-- Chart.js Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('taskStatusChart').getContext('2d');
        const taskStatusChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pending', 'In Progress', 'Completed'],
                datasets: [{
                    label: 'Number of Tasks',
                    data: [
                        {{ isset($pendingCount) ? $pendingCount : 0 }},
                        {{ isset($inProgressCount) ? $inProgressCount : 0 }},
                        {{ isset($completedCount) ? $completedCount : 0 }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
@endsection
