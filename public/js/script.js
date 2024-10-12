// JS function to filter tasks
document.getElementById('searchBar').addEventListener('keyup', function() {
    let searchValue = this.value.toLowerCase();
    let tasks = document.getElementById('taskTable').getElementsByTagName('tr');

    for (let i = 0; i < tasks.length; i++) {
        let taskTitle = tasks[i].getElementsByTagName('td')[0].textContent.toLowerCase();
        let taskDescription = tasks[i].getElementsByTagName('td')[1].textContent.toLowerCase();

        if (taskTitle.includes(searchValue) || taskDescription.includes(searchValue)) {
            tasks[i].style.display = "";
        } else {
            tasks[i].style.display = "none";
        }
    }
});

