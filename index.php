<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        table a {
            text-decoration: none;
        }

        table a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function myFunction() {
            let r = confirm("ต้องการจะลบจริงหรือไม่");
            return r;
        }
    </script>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center ; color:pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
        <?php include "nav.php"; ?>
        
        <div class="mt-3 d-flex justify-content-between">
            <div>
                <span><label>หมวดหมู่</label></span>
                <span id="dropdown1" class="dropdown">
                    <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        --<?php echo isset($_GET['category']) ? $_GET['category'] : 'ทั้งหมด'; ?>--
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="Button2">
                        <li><a href="index.php" class="dropdown-item">ทั้งหมด</a></li>
                        <?php
                        $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");
                        $sql = "SELECT * FROM category";
                        foreach ($conn->query($sql) as $row) {
                            echo "<li><a class='dropdown-item' href='index.php?category=$row[name]'>$row[name]</a></li>";
                        }
                        $conn = null;
                        ?>
                    </ul>
                </span>
            </div>
            
            <!-- ตรวจสอบว่าผู้ใช้ที่ล็อกอินไม่ถูกแบนก่อนที่จะแสดงปุ่มสร้างกระทู้ใหม่ -->
            <?php if (isset($_SESSION['id']) && $_SESSION['role'] != 'b') { ?>
                <div><a href="newpost.php" class="btn btn-success btn-sm">
                        <i class="bi bi-plus"></i> สร้างกระทู้ใหม่</a></div>
            <?php } ?>
        </div>
        
        <table class="table table-striped mt-4">
            <?php
            $conn = new PDO("mysql:host=localhost;dbname=webboard;charset=utf8", "root", "");

            // กำหนดการกรองตามหมวดหมู่
            $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

            // กำหนด SQL ที่จะใช้ดึงข้อมูล โดยจะแสดงเฉพาะผู้ใช้ที่ไม่ได้ถูกแบน
            $sql = "SELECT t3.name, t1.title, t1.id, t2.login, t1.post_date, t1.user_id 
                    FROM post as t1 
                    INNER JOIN user as t2 ON (t1.user_id=t2.id AND t2.role != 'b')
                    INNER JOIN category as t3 ON (t1.cat_id = t3.id)";

            if ($categoryFilter != '') {
                $sql .= " WHERE t3.name = :category";
            }

            $sql .= " ORDER BY t1.post_date DESC";

            $stmt = $conn->prepare($sql);
            if ($categoryFilter != '') {
                $stmt->bindParam(':category', $categoryFilter);
            }

            $stmt->execute();
            while ($row = $stmt->fetch()) {
                echo "<tr><td> $row[0]  <a href='post.php?id=$row[2]' style='text-decoration:none'>$row[1]</a><br>$row[3] - $row[4]</td>";
                
                // เงื่อนไขการแสดงปุ่มแก้ไข
                if (isset($_SESSION['id']) && ($_SESSION['id'] == $row[5] || $_SESSION['role'] == 'a')) {
                  echo "<td><a href='editpost.php?id=$row[2]' class='btn btn-warning btn-sm mt-2 float-end me-3'><i class='bi bi-pencil'></i></a></td>";
                }

                // เงื่อนไขการแสดงปุ่มลบ
                if (isset($_SESSION['id']) && ($_SESSION['role'] == 'a' || $_SESSION['id'] == $row[5])) {
                echo "<td><a href='delete.php?id=$row[2]' class='btn btn-danger btn-sm mt-2 float-end me-3' onclick='return myFunction();'><i class='bi bi-trash'></i></a></td>";
                }


                echo "</tr>";
            }
            $conn = null;
            ?>
        </table>
        <ul>
        </ul>
    </div>
</body>

</html>
