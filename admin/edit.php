<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Operator</title>
    <link rel="stylesheet" href="../layout/style.css">
</head>

<body>
    <?php include '../layout/header.html' ?>
    <main>
        <h3>Edit Operator Data</h3>
        <?php
        require_once __DIR__ . '/../service/database.php';

        $id = $_GET['id'];
        $sql = "SELECT * FROM operators WHERE id='$id'";
        $data = mysqli_query($db, $sql);
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <form action="update.php" method="POST" aria-label="Edit operator form">
                <input type="hidden" name="id" value="<?= $d['id']; ?>">

                <label>
                    Name
                    <input type="text" name="name" value="<?= htmlspecialchars($d['name']); ?>" required>
                </label>

                <label>
                    Password
                    <input type="password" name="password" value="<?= htmlspecialchars($d['password']); ?>">
                </label>

                <label>
                    Role
                    <select name="role">
                        <option value="Admin" <?= $d['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="User" <?= $d['role'] == 'User' ? 'selected' : '' ?>>User</option>
                    </select>
                </label>

                <div>
                    <button type="submit" name="update">Update</button>
                </div>
            </form>
        <?php
        }
        ?>

    </main>

    <?php include '../layout/footer.html' ?>
</body>

</html>