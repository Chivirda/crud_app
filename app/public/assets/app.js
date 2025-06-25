let projectToDelete = null;

function confirmDeleteProject(projectId, projectName, tasksCount) {
    projectToDelete = projectId;
    document.getElementById('projectNameToDelete').textContent = projectName;
    document.getElementById('tasksCountToDelete').textContent = tasksCount;

    const modal = new bootstrap.Modal(document.getElementById('deleteProjectModal'));
    modal.show();
}

function deleteProject() {
    if (projectToDelete) {

        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteProjectModal'));
        modal.hide();

        fetch('/projects/delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
            },
            body: new URLSearchParams({id: projectToDelete})
        });

        setTimeout(() => location.reload(), 50)

        projectToDelete = null;
    }
}
