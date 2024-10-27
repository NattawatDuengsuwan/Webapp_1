<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'a') {
    // ตรวจสอบว่าเป็นผู้ดูแลระบบหรือไม่
    header("Location: index.php");
    exit();
}

$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ตรวจสอบว่ามีข้อมูลจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $fullname = trim($_POST['fullname']);
    $gender = trim($_POST['gender']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);

    // แก้ไขข้อมูลผู้ใช้ในฐานข้อมูล
    $sql = "UPDATE user SET fullname = :fullname, gender = :gender, email = :email, role = :role WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();

    // ส่งผู้ใช้กลับไปที่หน้า user.php พร้อมกับข้อความแจ้งเตือน
    header("Location: user.php?edit_success=1");
    exit();
} else {
    // ถ้าไม่มีข้อมูล ให้กลับไปที่หน้า user.php
    header("Location: user.php");
    exit();
}
?>
