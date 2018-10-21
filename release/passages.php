<?php
$q = intval($_GET['q']);
$w = intval($_GET['w']);

$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM passages WHERE cid = " . $q . ";";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);

$pagecharlim = 2438;
$linelen = 71;
$content = $row['pcontent'];
$content = str_replace("<", "\n", $content);

if ($w != 99999)
{
$content = str_replace(' ', '`', $content);
$findme   = "\n";
$pos = strpos($content, $findme);
while ($pos !== false)
{
    $str_to_insert = (str_repeat("`", ($linelen-($pos%$linelen)-1))).">";
    $content = substr_replace($content, $str_to_insert, $pos, 1);
    $pos = strpos($content, $findme);
}
}

$cropped = $content;
$start = $pagecharlim*$w;
if ($w == 99999) {$pagecharlim = 2147483647; $start = 0;}
if(strlen($content) > $pagecharlim)
{
    $cropped = substr($content, $start, $pagecharlim);
}
$cropped = str_replace('`', ' ', $content);
$cropped = str_replace(">", "<br>", $cropped);

class NObj
{
    public $passage;
    public $pagemax;
    public $nextpagecid;
    public $prevpagecid;
}
$myObj = new NObj();

$myObj->passage = $cropped;//"<span class='cardf'>" . $cropped . "</span>";

if (strlen(substr($content, $start)) < $pagecharlim)
{
    $myObj->pagemax = 1;
}
else $myObj->pagemax = 0;

$sql="SELECT * FROM passages WHERE cid = " . ($q+1) . ";";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_array($result);
    $myObj->nextpagecid = $row['cid'];
}
else $myObj->nextpagecid = 0;

$sql="SELECT * FROM passages WHERE cid = " . ($q-1) . ";";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_array($result);
    $myObj->prevpagecid = $row['cid'];
}
else $myObj->prevpagecid = 0;

$myJSON = json_encode($myObj);
echo $myJSON;

mysqli_close($con);
?>