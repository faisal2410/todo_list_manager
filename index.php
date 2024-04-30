<?php
require_once "functions.php";

$task = $_GET['task'] ?? 'list';
$error = $_GET['error'] ?? '0';

if ('delete' == $task) {
    $id = htmlspecialchars($_GET['id']);
    if ($id > 0) {
        deleteTask($id);
        header('location: index.php?task=list');
    }
}

if ('seed' == $task) {
    seedTasks();
    $info = "Seeding is completed";
}

$info = "";

if (isset($_POST['submit'])) {
    if ('edit' == $task) {
        $id = $_GET['id'];
    }
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $status = htmlspecialchars($_POST['status']);

    if (isset($id)) {
        // Update existing task
        if ($title != '' && $description != '') {
            $result = updateTask($id, $title, $description, $status);
            if ($result) {
                header('location: index.php?task=list');
            } else {
                $error = 1;
            }
        }
    } else {
        // Add new task
        if ($title != '' && $description != '') {
            $result = addTask($title, $description, $status);
            if ($result) {
                header('location: index.php?task=list');
            } else {
                $error = 1;
            }
        }
    }
}

// Display different views based on the task
switch ($task) {
    case 'list':
        include_once "templates/header.php";
        include_once "templates/nav.php";
        include_once "templates/list.php";
        break;
    case 'add':
        include_once "templates/header.php";
        include_once "templates/nav.php";
        include_once "templates/add.php";
        break;
    case 'edit':
        include_once "templates/header.php";
        include_once "templates/nav.php";
        include_once "templates/edit.php";
        break;
    default:
        include_once "templates/header.php";
        include_once "templates/nav.php";
        include_once "templates/list.php";
        break;
}
