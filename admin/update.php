<?php
require_once __DIR__ . '/../service/database.php';

$id = $_POST['id'];
$name = $_POST['name'];
$role = $_POST['role'];
$password = $_POST['password'];
$hash_password = hash('sha256', $password);

$sql = "UPDATE operators SET name='$name', role='$role', password='$hash_password' WHERE id='$id'";

mysqli_query($db, $sql);

header("Location: dashboard.php");
