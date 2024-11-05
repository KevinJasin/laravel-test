@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Task Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $task->title }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $task->description }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $task->status }}</p>
            <p class="card-text"><strong>Due Date:</strong> {{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</p>
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Task List</a>
        </div>
    </div>
</div>
@endsection
