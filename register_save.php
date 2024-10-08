<?php
session_start();

$login = $_POST['login'];
$password = $_POST['pwd'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$email = $_POST['email'];

try {
    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM user WHERE login = :login";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['login' => $login]);

    if ($stmt->rowCount() == 1) {
        $_SESSION['add_login'] = "error";
    } else {
        $hashed_password = sha1($password);

        $sql1 = "INSERT INTO user (login, password, name, gender, email, role) 
                 VALUES (:login, :password, :name, :gender, :email, 'm')";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute([
            'login' => $login,
            'password' => $hashed_password,
            'name' => $name,
            'gender' => $gender,
            'email' => $email
        ]);

        $_SESSION['add_login'] = "success";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
header("location:register.php");
die();
