<?php
$content = $_GET['content'];
$cid = intval($_GET['id']);
$iid = intval($_GET['insertid']);
$did = intval($_GET['deleteid']);
$ino = intval($_GET['insertn']);
$dno = intval($_GET['deleten']);

$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if ($iid != 0)
{
    $sql="SELECT * FROM `catalogue`;";
    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
    if ($iid < 0 || $iid > $num) echo "update failed: catalogue id must be between 0 and max id";
    else
    {
        for ($x = $num; $x >= $iid; $x--)
        {
            $sql="UPDATE `catalogue` SET `cid` = " . ($x+1) . " WHERE `catalogue`.`cid` = " . $x . ";";
            $result = mysqli_query($con,$sql);
            $sql="UPDATE `passages` SET `cid` = " . ($x+1) . " WHERE `passages`.`cid` = " . $x . ";";
            $result = mysqli_query($con,$sql);
        }
        $sql="INSERT INTO `catalogue`(`cid`, `ccontent`) VALUES (" . $iid . ", '');";
        $result = mysqli_query($con,$sql);
        echo "updated insertion";
    }
}
else if ($did != 0)
{
    $sql="SELECT * FROM `catalogue`;";
    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
    if ($did < 0 || $did > $num) echo "update failed: catalogue id must be between 0 and max id";
    else
    {
        $sql="DELETE FROM `catalogue` WHERE cid = " . $did . ";";
        $result = mysqli_query($con,$sql);
        $sql="DELETE FROM `passages` WHERE cid = " . $did . ";";
        $result = mysqli_query($con,$sql);
        for ($x = $did; $x <= ($num-1); $x++)
        {
            $sql="UPDATE `catalogue` SET `cid` = " . $x . " WHERE `catalogue`.`cid` = " . ($x+1) . ";";
            $result = mysqli_query($con,$sql);
            $sql="UPDATE `passages` SET `cid` = " . $x . " WHERE `passages`.`cid` = " . ($x+1) . ";";
            $result = mysqli_query($con,$sql);
        }
        echo "updated deletion";
    }
}
else if ($ino != 0)
{
    $sql="SELECT * FROM `catalogue`;";
    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
    if ($ino >= 30) echo "update failed: no. of rows to insert must be less than 30";
    else
    {
        for ($x = 1; $x <= $ino; $x++)
        {
            $sql="INSERT INTO `catalogue`(`cid`, `ccontent`) VALUES (" . ($num+$x) . ", '');";
            $result = mysqli_query($con,$sql);
        }
        echo "updated row insertion";
    }
}
else if ($dno != 0)
{
    $sql="SELECT * FROM `catalogue`;";
    $result = mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
    if ($dno > ($num - 1)) echo "update failed: no. of rows to delete must be less than total no. of rows";
    else
    {
        for ($x = 0; $x < $dno; $x++)
        {
            $sql="DELETE FROM `catalogue` WHERE cid = " . ($num-$x) . ";";
            $result = mysqli_query($con,$sql);
            $sql="DELETE FROM `passages` WHERE cid = " . ($num-$x) . ";";
            $result = mysqli_query($con,$sql);
        }
        echo "updated row deletion";
    }
}
else
{
$sql="UPDATE `catalogue` SET `ccontent` = '" . $content . "' WHERE `catalogue`.`cid` = " . $cid . ";";
$result = mysqli_query($con,$sql);
if ($result == true) echo "updated";
else echo "update failed";
}

mysqli_close($con);
?>