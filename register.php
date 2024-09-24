<?php
session_start();
if (isset($_SESSION['id'])) {
    header("location:index.php");
    die();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register.html</title>
</head>

<body>
    <h1 style="text-align: center ; color:pink">สมัครสมาชิก 🐱</h1>
    <hr>
    <table style="border: 2px solid black; width: 30%;" align="center">
        <tr>
            <td colspan="2" align="center" style="background-color: #6cd2fe;">กรอกข้อมูล</td>
        </tr>
        <tr>
            <td>ชื่อบัญชี : </td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>รหัสผ่าน : </td>
            <td><input type="password" name="Password"></td>
        </tr>
        <tr>
            <td>ชื่อ-นามสกุล : </td>
            <td><input type="text" name="username-lastname"></td>
        </tr>
        <tr>
            <td>เพศ : <br></td>
            <td><input type="radio" name="gender">ชาย 🧑 <br>
                <input type="radio" name="gender">หญิง 👩 <br>
                <input type="radio" name="gender">อื่นๆ 🤷 <br>
        <tr>
            <td>อีเมล : </td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="สมัครสมาชิก"></td>
        </tr>
    </table>
    <br>
    <div style="text-align: center;">
        <a href="index.php">กลับไปหน้าเเรก🏡 </a>
    </div>
</body>

</html>