<?php
session_start();
if (isset($_SESSION['id'])) {
    header("location:index.php");
    die();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vetify</title>

</head>

<body>
    <h1 style="text-align: center ; color:pink">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
    <hr>

    <div style="text-align: center;">
        <?php
        $login = $_POST["Login"];
        $password = $_POST["Password"];
        if ($login == "admin" && $password == "a1234") {
            echo "ยินดีต้อนรับคุณ ADMIN";
            $_SESSION['username'] = 'admin🐱';
            $_SESSION['role'] = 'a';
            $_SESSION['id'] = 1;
        } else if ($login == "member" && $password == "mem1234") {
            echo "ยินดีตอนรับคุณ MEMBER";
            $_SESSION['username'] = 'member🐱';
            $_SESSION['role'] = 'm';
            $_SESSION['id'] = 2;
        } else echo "ชื่อบัญหรือรหัสผ่านไม่ถูกต้อง";
        ?>
    </div>
    <br>
    <div align="center"><a href="index.php">กลับไปหน้าหลัก🏡</a></div>
</body>

</html>