<?php

include 'service/database.php';
session_start();

$login_message = "";

if (isset($_SESSION["is_login"]) && $_SESSION["role"] == "User") {
    header("Location: dashboard.php");
} elseif (isset($_SESSION["is_login"]) && $_SESSION["role"] == "Admin") {
    header("Location: admin/dashboard.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hash_password = hash('sha256', $password);

    $sql = "SELECT * FROM operators WHERE name='$username' AND password='$hash_password'";

    $result = $db->query($sql);

    if ($result->num_rows > 0) {

        $data = $result->fetch_assoc();
        $_SESSION["name"] = $data["name"];
        $_SESSION["role"] = $data["role"];
        $_SESSION["is_login"] = true;

        if ($_SESSION["role"] == "User") {
            header("Location: dashboard.php");
        } elseif ($_SESSION["role"] == "Admin") {
            header("Location: admin/dashboard.php");
        }
    } elseif ($result->num_rows == 0) {

        $login_message = "Invalid username or password";
    } else {

        $login_message = "Error: " . $db->error;
    }
    $db->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="layout/style.css">
</head>

<body>
    <?php include 'layout/header.html' ?>

    <div style="padding: 20px;">
        <h3>Masuk Akun</h3>
        <i><?= $login_message ?></i>
        <form action="login.php" method="POST">
            <input type="text" name="username"
                placeholder="Username" />
            <input type="password" name="password"
                placeholder="Password" />
            <button type="submit" name="login">Masuk Sekarang</button>
        </form>
    </div>

    <?php include 'layout/footer.html' ?>
</body>

</html>