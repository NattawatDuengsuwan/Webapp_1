<?php
    session_start();
    if (isset($_SESSION["id"])){
        header("location:index.php");
        die();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
	<div class="container">
    <h1 style="text-align: center ; color:pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
    	<?php include "nav.php"?>
		<div class="row mt-4" >
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="card border-primary">
					<div class="card-header bg-primary">เข้าสู่ระบบ <i class="bi bi-person-fill"></i></div>
					<div class="card-body">
						<form action="register_save.php" method="post">
							<div class="row mt-3">
								<label class="col-lg-3">ชื่อบัญชี : </label>
								<div class="col-lg-9">
									<input type="text" name="login" require class="form-control">
								</div>
							</div>
							<div class="row mt-3">
								<label class="col-lg-3">รหัสผ่าน : </label>
								<div class="col-lg-9">
									<input type="password" name="pwd" require class="form-control">
								</div>
							</div>							
							<div class="row mt-3">
								<label class="col-lg-3">ชื่อ-นามสกุล : </label>
								<div class="col-lg-9">
									<input type="text" name="name" require class="form-control">
								</div>
							</div>							
							<div class="row mt-3">	
								<label class="col-lg-3">เพศ : </label>
								<div class="col-lg-9">
									<div class="form-check">
										<input type="radio" name="gender" require value="m" class="form-check-input">
										<label class="form-check-label">ชาย🧑</label>
									</div>									
									<div class="form-check">
										<input type="radio" name="gender" require value="f" class="form-check-input">
										<label class="form-check-label">หญิง👩</label>
									</div>									
									<div class="form-check">
										<input type="radio" name="gender" require value="o" class="form-check-input">
										<label class="form-check-label">อื่นๆ🤷</label>
									</div>
								</div>
							</div>
							<div class="row mt-3">
								<label class="col-lg-3">อีเมล์ : </label>
								<div class="col-lg-9">
									<input type="email" name="email" require class="form-control">
								</div>
							</div>
							<div class="row mt-3">
							<label class="col-lg-3"></label>
								<div class="col-lg-9">
									<button type="submit" class="btn btn-primary"><i class="bi bi-arrow-down-square"></i> สมัครสมาชิก</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</body>
</html>