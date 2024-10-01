<?php
    session_start();
    if (isset($_SESSION["id"])){
        header("location:index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
</head>
<body>
<h1 style="text-align: center ; color:pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
    <hr>
    <div align="center">        
        <?php
            $login = $_POST['login'];
            $pwd = $_POST['pwd'];
            if($login=="admin" && $pwd=="a1234"){
                echo "ยินดีต้อนรับคุณ ADMIN";
                $_SESSION['username']='admin🐱';
                $_SESSION['role']='a';
                $_SESSION['id']=session_id();
                header("Location:index.php");
                die();
            }elseif($login=="member" && $pwd=="mem1234"){
                echo "ยินดีต้อนรับคุณ MEMBER";
                $_SESSION['username']='member🐱';
                $_SESSION['role']='m';
                $_SESSION['id']=session_id();
                header("Location:index.php");
                die();
            }else{
                $_SESSION['error']='error';
                header("Location:login.php");
                die();
            }
            ?>
            
        
    </div>
</body>
</html>