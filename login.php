<?php
$u = $_POST['username'];
$p = $_POST['password'];

$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$login = 0;
$sql="SELECT * FROM loginInfo WHERE username = '" . $u . "' AND password = '" . $p . "';";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) == 1) $login = 1;
if ($login == 0) 
{
        header("Location: http://www.gracesworld.co.nf");
}
echo $login;
//$row['username'];
//$row = mysqli_fetch_array($result);

mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<body>

Welcome Letter
<form action="mod_wel_let.php">
<textarea name="welcome_letter" rows="10" cols="30">
<?php
$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM welcomeLetter;";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) == 1)
{
    $row = mysqli_fetch_array($result);
    echo $row['wlcontent'];
}
?>
</textarea>
<input type="submit" value="Submit">
</form>

</body>
</html>