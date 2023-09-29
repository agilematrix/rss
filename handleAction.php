<!-- handleAction.php -->

<?php

// Get the action from the query parameter
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Handle different actions
switch ($action) {
    case 'add':
        echo '<p>Add new feed item form goes here.</p>';
        break;

    case 'update':
        echo '<p>Update feed item form goes here.</p>';
        break;

    case 'delete':
        echo '<p>Delete feed item form goes here.</p>';
        break;

    default:
        echo '<p>Select an action to see results.</p>';
        break;
}

?>
