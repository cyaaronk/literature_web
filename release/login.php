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
echo "Logged in.<br><br>";
//$row['username'];
//$row = mysqli_fetch_array($result);

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function send_grequest(str)
{
    var xmlhttp;
    if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
    }
    else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
            location.reload();
	}
    };
    xmlhttp.open("GET",str,true);
    xmlhttp.send();
}
function wmod() {
    var d = document.getElementById("welcome_letter").value;
    var myLineBreak = d.replace(/\r\n|\r|\n/g, '<');
    send_grequest("mod_wel_let.php?welcome_letter="+myLineBreak);
}
function cmod(x) {
    var c = document.getElementById("ccontent"+x).value;
    send_grequest("mod_cata.php?id="+x+"&content="+c);
}
function cinsert() {
    var e = document.getElementById("insertid").value;
    send_grequest("mod_cata.php?insertid="+e);
}
function cdelete() {
    var f = document.getElementById("deleteid").value;
    send_grequest("mod_cata.php?deleteid="+f);
}
function cninsert() {
    var g = document.getElementById("insertn").value;
    send_grequest("mod_cata.php?insertn="+g);
}
function cndelete() {
    var h = document.getElementById("deleten").value;
    send_grequest("mod_cata.php?deleten="+h);
}
function addp(pid, add) {
    send_grequest("mod_pass.php?id="+pid+"&add="+add);
}
function getp()
{
        $('html,body').animate({
            scrollTop: $('#passage').position().top}, 1000 );
        document.getElementById("passage").innerHTML = "Loading...";
        // get passage
	if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp = new XMLHttpRequest();
	}
	else {
	// code for IE6, IE5
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
        
	xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var jsonResponse = JSON.parse(this.responseText);
                
                document.getElementById("passage").innerHTML = jsonResponse.passage;
            }
	};
        var z = document.getElementById("pid").value;
        var y = 99999;
	xmlhttp.open("GET","passages.php?q="+z+"&w="+y,true);
	xmlhttp.send();
}
function modp() {
    var a = document.getElementById("pid").value;
    var b = document.getElementById("passage").value;
    var myLineBreak = b.replace(/\r\n|\r|\n/g, '<');
    send_grequest("mod_pass.php?id="+a+"&passage="+myLineBreak);
}
function twimod()
{
    var a = document.getElementById("twitter").value;
    send_grequest("mod_info.php?twimod="+a);
}
</script>

<body>

Welcome Letter
<br>
<textarea id="welcome_letter" rows="10" cols="42">
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
    $content = $row['wlcontent'];
    $content = str_replace("<", "\n", $content);
    echo $content;
}
?>
</textarea>
<br>
<input type="submit" value="Submit" onclick="wmod()">
<br><br>

Catalogue
<br>
<?php
$con = mysqli_connect('fdb18.biz.nf','2633618_gracesworld','grace228','2633618_gracesworld');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM catalogue ORDER BY cid;";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    $content = $row['ccontent'];
    $cid = $row['cid'];
    echo $cid .
         "
                <input type='text' id='ccontent" . $cid . "' value='" . $content . "' size='38'>
                <input type='submit' value='Submit' onclick='cmod(" . $cid . ")'>
                <input type='submit' value='add passage link' onclick='addp(" . $cid . ", 1)'>
                <input type='submit' value='del passage link' onclick='addp(" . $cid . ", -1)'>
                <br>
          ";
}
?>
<br>
<input type='text' id='insertid' placeholder='type catalogue id to insert'>
<input type='submit' value='insert' onclick="cinsert()">
<br>
    
<input type='text' id='deleteid' placeholder='type catalogue id to delete'>
<input type='submit' value='delete' onclick="cdelete()">
<br>

<input type='text' id='insertn' placeholder='type no. of rows to insert'>
<input type='submit' value='insert' onclick="cninsert()">
<br>
    
<input type='text' id='deleten' placeholder='type no. of rows to delete'>
<input type='submit' value='delete' onclick="cndelete()">
<br><br>

Passage
<br>
<textarea id="passage" value='Enter your passage here.' rows="58" cols="71"></textarea>
<br>
<input type='text' id='pid' placeholder='type catalogue id'>
<input type='submit' value='Get' onclick="getp()">
<input type='submit' value='Edit' onclick="modp()">
<br><br>

Twitter
<input type='text' id='twitter' placeholder='type your twitter link' size='128'>
<input type='submit' value='Submit' onclick='twimod()'>

</body>
</html>