

<div>
    <ul id="sortable">
        @foreach ($tasks as $task)
            <li class="task project-{{ $task->project->id }}"
                data-taskid="{{ $task->id }}">
                <h3>{{ $task->name }} <a href="/tasks/{{ $task->id }}/edit">Edit</a></h3>
                <p>Project: {{ $task->project->name }}</p>
            </li>
        @endforeach
    </ul>
</div>

@push('scripts')
    <script src="{{ asset('js/sortable.min.js') }}"></script>
    <script>
        // new Sortable(document.getElementById('sortable'), {
        //     // Specify options for the sortable library as needed
        // });

        document.addEventListener("DOMContentLoaded", function() {
            const taskList = document.getElementById("sortable");
            const taskIds = [];

            Sortable.create(taskList, {
                animation: 150,
                onEnd: function() {
                    const tasks = taskList.getElementsByClassName("task");
                    Array.from(tasks).forEach(function(task, index) {
                        taskIds.push(task.dataset.taskid);
                    });

                    // Send AJAX request to update task priorities
                    fetch("/tasks/reorder", {
                            method: "post",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content"),
                            },
                            body: JSON.stringify({
                                taskIds: taskIds
                            }),
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            console.log("Success:", data);
                        })
                        .catch((error) => {
                            console.error("Error:", error);
                        });

                    // Clear taskIds array
                    taskIds.length = 0;
                },
            });
        });
    </script>
@endpush
