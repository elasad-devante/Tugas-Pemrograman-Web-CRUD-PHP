<?php

require_once __DIR__ . '/../service/database.php';
session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM operators WHERE id='$id'";
    if ($db->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error deleting record: " . $db->error;
    }
} else {
    echo "ID not provided.";
}
