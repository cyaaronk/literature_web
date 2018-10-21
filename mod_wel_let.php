<?php
$q = $_GET['welcome_letter'];

$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="UPDATE `welcomeLetter` SET `wlcontent` = '" . $q . "' WHERE `welcomeLetter`.`wlid` = 1;";
$result = mysqli_query($con,$sql);
if ($result == true) echo "updated";
else echo "update failed";

mysqli_close($con);
?>