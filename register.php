<?php
    include "service/database.php";
    session_start();

    if(isset($_SESSION['is_login']) && $_SESSION['is_login']){
        header("Location: dashboard.php");
        exit();
    }

    $register_message = "";
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hash_password = hash("sha256",$password);

        // Cek apakah username sudah ada
        $check_sql = "SELECT * FROM users WHERE username='$username'";
        $check_result = $db->query($check_sql);

        if($check_result->num_rows > 0){
            $register_message = "Username sudah ada, silakan pilih username lain";
        } else {
            try {
                $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hash_password')";
                if($db->query($sql)){
                    $register_message = "Berhasil mendaftar, lanjut login";
                } else {
                    $register_message = "Gagal mendaftar";
                }
            } catch (mysqli_sql_exception $e) {
                $register_message = "Error: " . $e->getMessage();
            }
        }
    }

    $db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php include "layout/header.html" ?>

    <h3>DAFTAR AKUN</h3>
    <i><?= $register_message ?></i>
    <form action="register.php" method="post">
        <input type="text" placeholder="username" name="username" required>
        <input type="password" placeholder="password" name="password" required>
        <button type="submit" name="register">Daftar sekarang</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>