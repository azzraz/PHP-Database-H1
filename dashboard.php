<?php
    session_start();

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }

    include "service/database.php";
    $db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php include "layout/header.html" ?>

    <h3> Selamat datang <?= $_SESSION["username"] ?> </h3>

    <form method="post">
        <button type="submit" name="logout">Logout</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>