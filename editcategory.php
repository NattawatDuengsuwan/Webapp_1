<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'a') {
    // ตรวจสอบว่าเป็นผู้ดูแลระบบหรือไม่
    header("Location: index.php");
    exit();
}

$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ตรวจสอบว่ามีข้อมูลจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_category_id'])) {
    $edit_id = $_POST['edit_category_id'];
    $edit_name = trim($_POST['edit_category_name']);
    
    // แก้ไขข้อมูลในฐานข้อมูล
    $sql = "UPDATE category SET name = :name WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $edit_name);
    $stmt->bindParam(':id', $edit_id);
    $stmt->execute();

    // ส่งผู้ใช้กลับไปที่หน้า category.php พร้อมกับข้อความแจ้งเตือน
    header("Location: category.php?edit_success=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>จัดการหมวดหมู่</title>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center; color: pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
        <?php include "nav.php"; ?>

        <!-- แสดงข้อความแจ้งเตือนความสำเร็จ -->
        <?php if (isset($_GET['edit_success']) && $_GET['edit_success'] == 1): ?>
            <div class="alert alert-success text-center" role="alert">
                แก้ไขหมวดหมู่เรียบร้อยแล้ว
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <h3 class="text-center">จัดการหมวดหมู่</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th style="width: 10%;">ลำดับ</th>
                        <th style="width: 70%;">ชื่อหมวดหมู่</th>
                        <th style="width: 20%;">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ดึงข้อมูลหมวดหมู่ทั้งหมดจากฐานข้อมูล
                    $sql = "SELECT * FROM category ORDER BY id ASC";
                    $categories = $conn->query($sql);
                    $order = 1;
                    
                    foreach ($categories as $category): ?>
                        <tr>
                            <td><?php echo $order++; ?></td>
                            <td><?php echo $category['name']; ?></td>
                            <td>
                                
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?php echo $category['id']; ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="category.php?delete_id=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบหมวดหมู่นี้จริงหรือไม่?');"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                        
                        <div class="modal fade" id="editCategoryModal<?php echo $category['id']; ?>" tabindex="-1" aria-labelledby="editCategoryModalLabel<?php echo $category['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCategoryModalLabel<?php echo $category['id']; ?>">แก้ไขหมวดหมู่</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="category.php">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="edit_category_name" class="form-label">ชื่อหมวดหมู่:</label>
                                                <input type="text" id="edit_category_name" name="edit_category_name" class="form-control" value="<?php echo $category['name']; ?>" required>
                                                <input type="hidden" name="edit_category_id" value="<?php echo $category['id']; ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- ปุ่มเพิ่มหมวดหมู่ใหม่ -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="bi bi-bookmark"></i> เพิ่มหมวดหมู่ใหม่
            </button>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
