<?php
    session_start();
    if(!isset($_SESSION["id"])){        
        header("location:index.php");
        die();      
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>newpost</title>
</head>
<body>
    <div class="container">
    <h1 style="text-align: center ; color:pink;" class="mt-3">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
        <?php include "nav.php" ?>
        <div class="row mt-4">
            <div class="col-lg-3 col-md-2 col-sm-1"></div>
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card border-info">
                    <div class="card-header bg-info text-white">ตั้งกระทู้ใหม่</div>
                    <div class="card-body">
                        <form action="newpost_save.php" method="post">
                            <div class="row">
                                <label class="col-lg-3 col-form-label">หมวดหมู่:</label>
                                <div class="col-lg-9">
                                    <select name="category" class="form-select">
                                    <option value="all">-- ทั้งหมด --</option>
                                    <option value="drink">เครื่องดื่ม🧋</option>
                                    <option value="food">อาหาร🥣</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-lg-3 col-form-label">หัวข้อ💭 :</label>
                                <div class="col-lg-9">
                                    <input type="text" name="topic" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-lg-3 col-form-label">เนื้อหา📃 :</label>
                                <div class="col-lg-9">
                                    <textarea name="comment" rows="8" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-info btn-sm text-white me-2">
                                    <i class="bi bi-caret-right-square"></i> บันทึกข้อความ</button>
                                <button type="reset" class="btn btn-danger btn-sm"><i class="bi bi-x-square"></i> ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm-1"></div>
        </div>
    </div>
    <br>
    
</body>
</html>
