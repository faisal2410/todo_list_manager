<?php
define('DB_NAME', 'data/tasks.txt');

function seedTasks()
{
    $data = [
        [
            'id' => 1,
            'title' => 'Task 1',
            'description' => 'Description for Task 1',
            'status' => 'pending'
        ],
        [
            'id' => 2,
            'title' => 'Task 2',
            'description' => 'Description for Task 2',
            'status' => 'completed'
        ]
    ];
    $serializedData = serialize($data);
    file_put_contents(DB_NAME, $serializedData, LOCK_EX);
}


// Function to get a task by its ID
function getTask($id)
{
    $serializedData = file_get_contents(DB_NAME);
    $tasks = unserialize($serializedData);

    foreach ($tasks as $task) {
        if ($task['id'] == $id) {
            return $task;
        }
    }

    return null; // Return null if task with given ID is not found
}

function addTask($title, $description, $status)
{
    $newId = getNextTaskId();
    $task = [
        'id' => $newId,
        'title' => $title,
        'description' => $description,
        'status' => $status
    ];
    $serializedData = file_get_contents(DB_NAME);
    $tasks = unserialize($serializedData);
    $tasks[] = $task;
    $serializedTasks = serialize($tasks);
    file_put_contents(DB_NAME, $serializedTasks, LOCK_EX);
    return true;
}

// Implement other CRUD functions (updateTask, deleteTask, getNextTaskId) similarly.



// Function to update a task
function updateTask($id, $title, $description, $status)
{
    $serializedData = file_get_contents(DB_NAME);
    $tasks = unserialize($serializedData);

    foreach ($tasks as &$task) {
        if ($task['id'] == $id) {
            $task['title'] = $title;
            $task['description'] = $description;
            $task['status'] = $status;
            break;
        }
    }

    $serializedTasks = serialize($tasks);
    file_put_contents(DB_NAME, $serializedTasks, LOCK_EX);

    return true;
}

// Function to delete a task
function deleteTask($id)
{
    $serializedData = file_get_contents(DB_NAME);
    $tasks = unserialize($serializedData);

    foreach ($tasks as $key => $task) {
        if ($task['id'] == $id) {
            unset($tasks[$key]);
            break;
        }
    }

    $serializedTasks = serialize($tasks);
    file_put_contents(DB_NAME, $serializedTasks, LOCK_EX);
}

// Function to get the next available task ID
function getNextTaskId()
{
    $serializedData = file_get_contents(DB_NAME);
    $tasks = unserialize($serializedData);

    $maxId = 0;
    foreach ($tasks as $task) {
        if ($task['id'] > $maxId) {
            $maxId = $task['id'];
        }
    }

    return $maxId + 1;
}
?>
