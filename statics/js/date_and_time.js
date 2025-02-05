function openUpdateForm(id, title, description, dueDate, dueTime) {
    document.getElementById('updateId').value = id;
    document.getElementById('updateTitle').value = title;
    document.getElementById('updateDescription').value = description;
    document.getElementById('updateDueDate').value = dueDate;
    document.getElementById('updateDueTime').value = dueTime;
    document.getElementById('updateForm').style.display = 'block';
  }