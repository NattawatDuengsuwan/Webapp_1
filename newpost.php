<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:index.php");
    die();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 style="text-align: center ; color:pink">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
    <hr>

    <div>
        <?php echo "ผู้ใช้ : $_SESSION[username]" ?>
        <br>
        <table>
            <tr>
                <td>หมวดหมู่ :</td>
                <td> <select name="category">
                        <option value="all">-- ทั้งหมด --</option>
                        <option value="general">เครื่องดื่ม🧋</option>
                        <option value="study">อาหาร🥣</option>
                </td>
            </tr>
            </select>

            <tr>
                <td>หัวข้อ💭</td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td>เนื้อหา📃</td>
                <td><textarea cols="30" rows="5"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="บันทึกข้อความ"></td>
            </tr>
        </table>