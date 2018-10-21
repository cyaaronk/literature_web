<?php

$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

class NObj
{
    public $twitter;
}
$myObj = new NObj();

$sql="SELECT * FROM link WHERE lid = 1;";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$content = $row['llink'];
$myObj->twitter = $content;


$myJSON = json_encode($myObj);
echo $myJSON;

mysqli_close($con);
?>