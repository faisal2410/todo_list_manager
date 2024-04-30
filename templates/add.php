<div class="row">
    <div class="column column-60 column-offset-20">
        <h3>Add Task</h3>
        <form action="index.php?task=add" method="POST">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
            <label for="description">Description</label>
            <textarea name="description" id="description" required></textarea>
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
            <button type="submit" class="button-primary" name="submit">Add Task</button>
        </form>
    </div>
</div>