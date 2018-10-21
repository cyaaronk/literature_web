<?php
$twi = $_GET['twimod'];

$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="UPDATE `link` SET `llink`='" . $twi . "' WHERE lid = 1;";
$result = mysqli_query($con,$sql);

mysqli_close($con);
?>