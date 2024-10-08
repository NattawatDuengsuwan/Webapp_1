<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>New Post</title>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center; color:pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
        <?php include "nav.php"; ?>
        <div class="row mt-4">
            <div class="col-lg-3 col-md-2 col-sm-1"></div>
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card border-info">
                    <div class="card-header bg-info text-white">ตั้งกระทู้ใหม่</div>
                    <div class="card-body">
                        <form action="newpost_save.php" method="post">
                            <div class="mb-3">
                                <label for="category" class="form-label">หมวดหมู่:</label>
                                <select name="category" class="form-select" required>
                                    <<?php
                                        $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");
                                        $sql = "SELECT * FROM category";
                                        foreach ($conn->query($sql) as $row) {
                                            echo "<option value=$row[id]>$row[name]</option>";
                                        }
                                        $conn = null;
                                        ?>
                                        </select>
                            </div>
                            <div class="mb-3">
                                <label for="topic" class="form-label">หัวข้อ💭:</label>
                                <input type="text" name="topic" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">เนื้อหา📃:</label>
                                <textarea name="comment" rows="8" class="form-control" required></textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-info btn-sm text-white">
                                    <i class="bi bi-caret-right-square"></i> บันทึกข้อความ
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm ms-2">
                                    <i class="bi bi-x-square"></i> ยกเลิก
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-1"></div>
        </div>
    </div>
</body>

</html>