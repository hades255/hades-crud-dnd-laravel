<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $tasks = Task::orderBy('priority')->get();
        return view('welcome', compact('tasks', 'projects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'project_id' => 'required|string',
        ]);
        Task::create($validatedData);
        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task)
    {
        $taskIds = $request->input('taskIds');
        foreach ($taskIds as $key => $taskId) {
            $task = Task::find($taskId);
            $task->priority = $key + 1;
            $task->save();
        }
        return response()->json(['success' => true]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('edit', compact('task', 'projects'));
    }
}
