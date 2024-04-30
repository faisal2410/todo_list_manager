<?php

$id= $_GET['id'];
$task=getTask($id);

?>

<div class="row">
    <div class="column column-60 column-offset-20">
        <h3>Edit Task</h3>
        <form action="index.php?task=edit&id=<?= $task['id']; ?>" method="POST">
            <input type="hidden" name="id" value="<?= $task['id']; ?>">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?= $task['title']; ?>" required>
            <label for="description">Description</label>
            <textarea name="description" id="description" required><?= $task['description']; ?></textarea>
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="pending" <?= ($task['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="completed" <?= ($task['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
            </select>
            <button type="submit" class="button-primary" name="submit">Update Task</button>
        </form>
    </div>
</div>