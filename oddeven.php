<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $n =$_POST['number'];

    if (($n % 2)== 0)
        echo "Your number is an even number";
    else
        echo "Your number is an odd number";
    ?>
</body>
</html>