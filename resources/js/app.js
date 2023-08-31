// import './bootstrap';
import "bootstrap";
import Sortable from "sortablejs";

document.addEventListener("DOMContentLoaded", function () {
    const taskList = document.getElementById("taskList");
    const taskIds = [];

    Sortable.create(taskList, {
        animation: 150,
        onEnd: function () {
            const tasks = taskList.getElementsByClassName("task");
            Array.from(tasks).forEach(function (task, index) {
                taskIds.push(task.dataset.taskId);
            });

            // Send AJAX request to update task priorities
            fetch("/tasks", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ taskIds: taskIds }),
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
