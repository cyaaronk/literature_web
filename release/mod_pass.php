<?php
$content = $_GET['passage'];
$cid = intval($_GET['id']);
$add = intval($_GET['add']);

$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if ($add == 1)
{
    $sql="SELECT * FROM `passages` WHERE cid = " . $cid . ";";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result) == 0)
    {
        $sql="INSERT INTO `passages`(`cid`, `pcontent`) VALUES ( " . $cid . " , 'blank');";
        $result = mysqli_query($con,$sql);
        if ($result == true) echo "updated";
        else echo "update failed";
    }
}
else if ($add == -1)
{
    $sql="SELECT * FROM `passages` WHERE cid = " . $cid . ";";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result) == 1)
    {
        $sql="DELETE FROM `passages` WHERE cid = " . $cid . ";";
        $result = mysqli_query($con,$sql);
        if ($result == true) echo "updated";
        else echo "update failed";
    }
}
else
{
    $sql="UPDATE `passages` SET `pcontent` = '" . $content . "' WHERE `passages`.`cid` = " . $cid . ";";
    $result = mysqli_query($con,$sql);
    if ($result == true) echo "updated";
    else echo "update failed";
}

mysqli_close($con);
?>