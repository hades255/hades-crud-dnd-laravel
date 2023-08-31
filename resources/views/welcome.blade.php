@extends('layouts/app')

@section('content')
    <div>
        <label for="selectedProject">Select Project:</label>
        <select onchange="handleChange(this)">
            <option value="">All</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
    <hr>

    <div>
        @livewire('tasks-reorder')
    </div>

    <hr>

    <!-- Add new task form -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Task Name">
        <label for="project">Project:</label>
        <select id="project" name="project_id">
            <option value="">All</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
        <button type="submit">Add Task</button>
    </form>
@endsection

@push('scripts')
    <script>
        function handleChange(e) {
            const tasks = document.getElementsByClassName("task");
            Array.from(tasks).forEach(function(task, index) {
                if (e.value && !task.classList.contains("project-" + e.value)) task.style.display = "none";
                else task.style.display = "block";
            });
        }
    </script>
@endpush
