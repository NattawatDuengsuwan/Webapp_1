<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'a') {
    // ตรวจสอบว่าเป็นผู้ดูแลระบบหรือไม่
    header("Location: index.php");
    exit();
}

$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ตรวจสอบว่ามี ID ที่ต้องการลบหรือไม่
if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];
    
    // ลบข้อมูลหมวดหมู่ในฐานข้อมูล
    $sql = "DELETE FROM category WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $delete_id);
    $stmt->execute();

    // ส่งผู้ใช้กลับไปที่หน้า category.php พร้อมกับข้อความแจ้งเตือน
    header("Location: category.php?delete_success=1");
    exit();
} else {
    // ถ้าไม่มี ID ให้กลับไปที่หน้า category.php
    header("Location: category.php");
    exit();
}
?>
