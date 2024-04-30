<?php

            $serializedData = file_get_contents(DB_NAME);
            $tasks = unserialize($serializedData);

?>

<div class="row">
    <div class="column column-60 column-offset-20">
        <h3>All Tasks</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($tasks as $task) : ?>
                <tr>
                    <td><?= $task['title']; ?></td>
                    <td><?= $task['description']; ?></td>
                    <td><?= $task['status']; ?></td>
                    <td>
                        <a href="index.php?task=edit&id=<?= $task['id']; ?>">Edit</a> |
                        <a href="index.php?task=delete&id=<?= $task['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>