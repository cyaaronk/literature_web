<?php
$q = 1;//intval($_GET['q']);


$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

class NObj
{
    public $welcomeletter;
    public $catalogue;
}
$myObj = new NObj();

$sql="SELECT * FROM welcomeLetter WHERE wlid =" . $q . ";";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$content = "<span class='cardf'>" . $row['wlcontent'] . "</span>";
$myObj->welcomeletter = $content;

$sql="SELECT * FROM catalogue ORDER BY cid";
$result = mysqli_query($con,$sql);
$catastr = "<table>";
while($row = mysqli_fetch_array($result)) {
    $content = $row['ccontent'];
    $content = str_replace(' ', '&nbsp;', $content);
    
    $sql="SELECT * FROM passages WHERE cid =" . $row['cid'] . ";";
    $result2 = mysqli_query($con,$sql);
    if(mysqli_num_rows($result2) == 0)
    {
        $catastr .= "<tr>";
        $catastr .= "<td><span class='cataf'>" . $content . "</span></td>";
        $catastr .= "</tr>";
    }
    if(mysqli_num_rows($result2) > 0)
    {
        $catastr .= "<tr>";
        $catastr .= "<td><span class='cataf' onClick='open_letter(" . $row['cid'] . ")'>" . $content . "</span></td>";
        $catastr .= "</tr>";
    }
    
}
$catastr .= "</table>";
$myObj->catalogue = $catastr;

$myJSON = json_encode($myObj);
echo $myJSON;

mysqli_close($con);
?>