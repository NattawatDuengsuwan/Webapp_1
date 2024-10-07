<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Webboard</title>
    <script>
        function myFunction(){
            let r=confirm("ต้องการจะลบจริงหรือไม่");
            return r;
        }
    </script>
</head>
<body>
    <div class="container">
    <h1 style="text-align: center ; color:pink">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
    <?php include "nav.php" ?>
    
    <div class="mt-3 d-flex justify-content-between">
        <div>
            <label>หมวดหมู่</label>
            <span class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    --ทั้งหมด--
                </button>
                <ul class="dropdown-menu" aria-labelledby="Button2">
                    <li><a href="#" class="dropdown-item">ทั้งหมด</a></li>
                    <?php
                        $conn=new PDO("mysql:host=localhost;dbname=webboard;
                        charset=utf8","root","");
                        $sql="SELECT * FROM category";
                        foreach($conn->query($sql) as $row){
                            echo "<li><a class=dropdown-item href=#>$row[name]</a></li>";
                        }
                        $conn=null;
                    ?>
                </ul>
            </span>
        </div>
        <?php if(isset($_SESSION['id'])) {?>
            <div><a href="newpost.php" class="btn btn-success btn-sm"><i class="bi bi-plus"></i> สร้างกระทู้ใหม่</a></div>
        <?php }?>        
    </div>

    <table class="table table-striped mt-4">
        <?php 
            $conn=new PDO("mysql:host=localhost;dbname=webboard;charset=utf8","root","");
            $sql="SELECT t3.name,t1.title,t1.id,t2.login,t1.post_date FROM post as t1 
            INNER JOIN user as t2 ON (t1.user_id=t2.id)
            INNER JOIN category as t3 ON (t1.cat_id=t3.id) ORDER BY t1.post_date DESC";
            $result=$conn->query($sql);
            while($row = $result->fetch()){
                echo "<tr><td>[ $row[0] ] <a href=post.php?id=$row[2] 
                style=text-decoration:none>$row[1]</a><br>$row[3] - $row[4]</td>";
                if (isset($_SESSION['id']) && $_SESSION['role']=='a'){
                    echo "<td><a href=delete.php?id=$row[2] 
                    class='btn btn-danger btn-sm mt-2 float-end me-3' 
                    onclick='return myFunction()'>
                    <i class='bi bi-trash'></i></a></td>";
                }
                
                echo "</tr>";
            }
            $conn=null;      
        ?>
    </table>
    </div>
</body>
</html>
