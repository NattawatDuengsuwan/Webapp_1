<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index.html</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <h1 style="text-align: center ; color:pink">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
    <nav class="navbar navbar-expand-lg " style="background-color: #d3d3d3;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="bi bi-house-door-fill"></i>Home</a>


            <ul class="navbar-nav ">
                <?php
                if (!isset($_SESSION['id'])) {
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='login.php'><i class='bi bi-pencil-square'></i>เข้าสู่ระบบ</a>";
                    echo "</li>";
                } else {
                    echo "<li class='nav-item dropdown'>";
                    echo "<a class='btn btn-outline-secondary btn-sm dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>";
                    echo "<i class='bi bi-person-lines-fill'></i>$_SESSION[username]</a>";
                    echo "<ul class='dropdown-menu'>";
                    echo "<li><a class='dropdown-item' href='logout.php'><i class='bi bi-power'></i>ออกจากระบบ</a></li>";

                    echo "</ul></li>";
                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="mt-3">
        <br>
        <label>หมวดหมู่ :</label>
        <span class="dropdown">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                --ทั้งหมด--
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">เกม🎮</a></li>
                <li><a class="dropdown-item" href="#">เครื่องดื่ม🧋</a></li>
                <li><a class="dropdown-item" href="#">อาหาร🥣</a></li>
            </ul>
        </span>
        <?php
        
        if (isset($_SESSION['id'])){
         echo "<a href='newpost.php' class='btn btn-success btn-sm' 
            style='float: right;'>";
            echo "<i class=' bi bi-plus-lg'></i>สร้างกระทู้ใหม่</a>";
        }
            ?>
    </div>


    <table class="table table-striped mt-4">
        <?php
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr><td><a href='post.php?id=$i style='text-decoration'>ห้องนอนที่🛏 $i</a>";

            if (isset($_SESSION['role']) && $_SESSION['role'] == 'a') {
                echo "<a href=delete.php?id=$i class='btn btn-danger btn-sm me-3' style='float:right'><i class='bi bi-trash'></i></a>";
            }
            echo "</td></tr>";
        }
        ?>
    </table>

</body>

</html>