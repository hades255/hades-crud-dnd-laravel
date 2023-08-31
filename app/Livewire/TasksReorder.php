<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Http\Request;
use Livewire\Component;

class TasksReorder extends Component
{
    public $tasks;

    public $projects;

    protected $listeners = ['taskDropped' => 'reorderTasks'];

    public function mount()
    {
        $this->tasks = Task::orderBy('priority')->get();
    }

    public function render()
    {
        return view('livewire.tasks-reorder');
    }

    public function reorderTasks(Request $request)
    {
        foreach ($request->taskIds as $index => $taskId) {
            Task::find($taskId)->update(['priority' => $index + 1]);
        }
        $this->tasks = Task::orderBy('priority')->get();
        return response()->json($request->taskIds, 200);
    }
}
