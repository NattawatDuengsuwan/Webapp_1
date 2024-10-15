<?php
session_start();
if (isset($_SESSION["id"])) {
    header("location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <scrtip src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></scrtip>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <h1 style="text-align: center ; color:pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
        <?php include "nav.php" ?>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-4 col-md-3 col-sm-2 col-1"></div>
            <div class="col-lg-4 col-md-6 col-sm-8 col-10">
                <div class="card border-primary">
                    <?php if (isset($_SESSION['error'])) {
                        echo "<div class='alert alert-danger'>ชื่อบัญชีหรือรหัสผ่านไม่ถูกต้อง </div>";
                        unset($_SESSION['error']);
                    }
                    ?>
                    <div class="card bg-light text-dark">
                        <div class="card-header bg-primary">เข้าสู่ระบบ <i class="bi bi-person-fill"></i></div>
                        <div class="card-body">
                            <form action="verify.php" method="post">
                                <div class="form-group">
                                    <label class="form-label">Login :</label> <br>
                                    <input type="text" name="login" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password:</label>
                                    <div class="input-group">
                                        <input type="password" name="pwd" id="pwd" class="form-control">
                                        <span class="input-group-text" onclick="password_show_hide()">
                                            <i class="bi bi-eye-fill" id="show_eye"></i>
                                            <i class="bi bi-eye-slash-fill d-none" id="hide_eye"></i>
                                        </span>
                                        <script>
                                            function password_show_hide() {
                                                var passwordField = document.getElementById("pwd");
                                                var showEye = document.getElementById("show_eye");
                                                var hideEye = document.getElementById("hide_eye");

                                                if (passwordField.type === "password") {
                                                    passwordField.type = "text";
                                                    showEye.classList.add("d-none");
                                                    hideEye.classList.remove("d-none");
                                                } else {
                                                    passwordField.type = "password";
                                                    showEye.classList.remove("d-none");
                                                    hideEye.classList.add("d-none");
                                                }
                                            }
                                        </script>
                                    </div>
                                </div>

                                <div class="mt-3 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-sm me-2">Login</button>
                                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
    <br>
    <div align="center">ถ้ายังไม่ได้เป็นสมาชิก👉 <a href="register.php">กรุณาสมัครสมาชิก</a></div>
    </div>
</body>

</html>