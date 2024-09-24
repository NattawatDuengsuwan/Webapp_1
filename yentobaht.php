<?php
$rate = 0.24;

$y = $_GET['yen'];

$baht = $y * $rate;

echo "$y Yen = $baht Baht";

?>