<?php

session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../layout/style.css">
</head>

<body>
    <?php include '../layout/header.html' ?>

    <div style="padding: 20px;">
        <h3 style="padding-top: 20px;">Welcome Admin <?= $_SESSION["name"] ?></h3>
        <br />
        <table border="1">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>ID</th>
                <th>Options</th>
            </tr>
            <?php
            require_once __DIR__ . '/../service/database.php';
            if (!isset($db) && isset($conn)) {
                $db = $conn;
            }
            $no = 1;
            $sql = "SELECT * FROM operators";
            $data = $db->query($sql);
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['name'] ?></td>
                    <td><?= $d['id'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $d['id'] ?>">Edit</a>
                        <a href="delete.php?id=<?= $d['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <br />
        <form action="dashboard.php" method="POST">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>

    <?php include '../layout/footer.html' ?>
</body>

</html>