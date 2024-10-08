<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("location: index.php");
    exit();
}

$category = $_POST['category'];
$topic = $_POST['topic'];
$content = $_POST['comment'];
$user_id = $_SESSION['user_id'];

try {
    $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO post (title, content, post_date, cat_id, user_id)
            VALUES (:title, :content, NOW(), :cat_id, :user_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $topic);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':cat_id', $category);
    $stmt->bindParam(':user_id', $user_id);

    $stmt->execute();

    header("Location: index.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
