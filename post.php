<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post.php</title>
</head>

<body>
    <h1 style="text-align: center ; color:pink">คาเฟ่ เเมวไม่ได้นอน 🐱</h1>
    <hr>
    <div style="text-align: center;">
        <?php
        $x = $_GET['id'];
        echo "ต้องการดูห้องนอนที่🛏 = $x" . "<br>";
        if ($x % 2 == 0)
            echo "เป็นกระทู้หมายเลขคู่";
        else
            echo "เป็นกระทู้หมายเลขคี่";
        ?>
        <br><br>
        <table style="border: 2px solid black; width: 40px" align="center">
            <tr>
                <td>
                    <div style="background-color: #6CD2FE;">แสดงความคิดเห็น💬</div>
                </td>
            </tr>
            <tr>
                <td><textarea name="message" cols="60" rows="5"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" value="ส่งข้อความ"></td>
            </tr>
        </table>
        <br>
        <div style="text-align: center;"><a href="index.php">กลับไปหน้าหลัก🏡</a></div>


    </div>




</html>