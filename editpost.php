<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}


if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$post_id = $_GET['id'];
$user_id = $_SESSION['id'];
$role = $_SESSION['role'];

$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");


$sql = "SELECT user_id FROM post WHERE id = :post_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':post_id', $post_id);
$stmt->execute();
$post = $stmt->fetch();

if (!$post || ($post['user_id'] != $user_id && $role != 'a')) {
   
    header("Location: index.php");
    exit();
}


$sql = "SELECT title, content, cat_id FROM post WHERE id = :post_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':post_id', $post_id);
$stmt->execute();
$current_post = $stmt->fetch();


$sql = "SELECT * FROM category";
$categories = $conn->query($sql);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];


    $sql = "UPDATE post SET title = :title, content = :content, cat_id = :category WHERE id = :post_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->execute();

    
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Edit Post</title>
    <style>
        .edit-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #f0ad4e;
            border-radius: 10px;
            background-color: #fff3cd;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center ; color:pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
        <?php include "nav.php" ?>
        <div class="edit-form mt-5">
            <h3 class="text-center text-warning">แก้ไขกระทู้</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="category" class="form-label">หมวดหมู่</label>
                    <select id="category" name="category" class="form-select">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo $current_post['cat_id'] == $category['id'] ? 'selected' : ''; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">หัวข้อ</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $current_post['title']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">เนื้อหา</label>
                    <textarea id="content" name="content" class="form-control" rows="5" required><?php echo $current_post['content']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning w-100">บันทึกข้อความ</button>
            </form>
        </div>
    </div>
</body>

</html>
