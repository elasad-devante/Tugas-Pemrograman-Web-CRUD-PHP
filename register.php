<?php

include 'service/database.php';
session_start();

$register_message = "";

if (isset($_SESSION["is_login"]) && $_SESSION["role"] == "User") {
    header("Location: dashboard.php");
} else if (isset($_SESSION["is_login"]) && $_SESSION["role"] == "Admin") {
    header("Location: admin/dashboard.php");
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hash_password = hash('sha256', $password);

    try {
        $sql = "INSERT INTO operators (name, password, role) VALUES ('$username', '$hash_password', '$role')";

        if ($db->query($sql)) {
            $register_message = "Registration successful. You can now log in.";
        } else {
            $register_message = "Failed to register, please try again: " . $db->error;
        }
    } catch (mysqli_sql_exception $e) {
        $register_message = $e->getMessage();
    }
    $db->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="layout/style.css">
</head>

<body>
    <?php include 'layout/header.html' ?>

    <div style="padding: 20px;">
        <h3>Daftar Akun</h3>
        <i><?= $register_message ?></i>

        <form action="register.php" method="POST">
            <input type="text" name="username"
                placeholder="Username" />
            <input type="password" name="password"
                placeholder="Password" />
            <select name="role">
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select>
            <button type="submit" name="register">Daftar Sekarang</button>
        </form>
    </div>

    <?php include 'layout/footer.html' ?>
</body>

</html>