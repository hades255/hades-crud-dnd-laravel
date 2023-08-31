@extends('layouts/app')

@section('content')
    <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Task</button>
    </form>
    <hr>
    <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" placeholder="Task Name" value="{{ $task->name }}">
        <label for="project">Project:</label>
        <select id="project" name="project_id">
            <option value="">All</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" selected="{{ $task->project_id === $project->id }}">
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Update Task</button>
    </form>
@endsection
