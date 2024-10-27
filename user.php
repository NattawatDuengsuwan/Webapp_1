<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'a') {
    // ตรวจสอบว่าเป็นผู้ดูแลระบบหรือไม่
    header("Location: index.php");
    exit();
}

$conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

// ดึงข้อมูลผู้ใช้ทั้งหมดจากฐานข้อมูล
$sql = "SELECT * FROM user ORDER BY id ASC";
$users = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>จัดการผู้ใช้งาน</title>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center; color: pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
        <?php include "nav.php"; ?>

        <!-- แสดงข้อความแจ้งเตือนความสำเร็จ -->
        <?php if (isset($_GET['edit_success']) && $_GET['edit_success'] == 1): ?>
            <div class="alert alert-success text-center" role="alert">
                แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <h3 class="text-center">จัดการผู้ใช้งาน</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th style="width: 5%;">ลำดับ</th>
                        <th style="width: 15%;">ชื่อผู้ใช้</th>
                        <th style="width: 25%;">ชื่อ-นามสกุล</th>
                        <th style="width: 10%;">เพศ</th>
                        <th style="width: 25%;">อีเมล</th>
                        <th style="width: 10%;">สิทธิ์</th>
                        <th style="width: 10%;">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $order = 1; ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $order++; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['fullname']; ?></td>
                            <td><?php echo $user['gender']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td>
                                <!-- ปุ่มแก้ไขจะเรียกใช้ Modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal<?php echo $user['id']; ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal สำหรับแก้ไขข้อมูลผู้ใช้ -->
                        <div class="modal fade" id="editUserModal<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?php echo $user['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel<?php echo $user['id']; ?>">แก้ไขข้อมูลผู้ใช้</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="update_user.php">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">ชื่อผู้ใช้:</label>
                                                <input type="text" id="username" name="username" class="form-control" value="<?php echo $user['username']; ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="fullname" class="form-label">ชื่อ-นามสกุล:</label>
                                                <input type="text" id="fullname" name="fullname" class="form-control" value="<?php echo $user['fullname']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">เพศ:</label>
                                                <input type="text" id="gender" name="gender" class="form-control" value="<?php echo $user['gender']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">อีเมล:</label>
                                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="role" class="form-label">สิทธิ์:</label>
                                                <select id="role" name="role" class="form-select" required>
                                                    <option value="m" <?php echo ($user['role'] == 'm') ? 'selected' : ''; ?>>Member</option>
                                                    <option value="a" <?php echo ($user['role'] == 'a') ? 'selected' : ''; ?>>Admin</option>
                                                    <option value="b" <?php echo ($user['role'] == 'b') ? 'selected' : ''; ?>>Band</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
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
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>

