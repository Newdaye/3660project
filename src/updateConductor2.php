<?php
if (isset($_COOKIE["username"])) {
$username = $_COOKIE["username"];
$password = $_COOKIE["password"];

$conn = new mysqli("vconroy.cs.uleth.ca",$username,$password,$username);
$sql = "update CONDUCTOR set condName='$_POST[name]' phoneNum = '$_POST[pnum]'
age='$_POST[age]' Certification='$_POST[cert]' where ID='$_rec[ID]'";
$result = $conn->query($sql);

if($result)
{
	echo "<h3> Conductor updated!</h3>";

} else {
   $err = $conn->errno();
   if($err == 1062)
   {
      echo "<p>Conductor name $_POST[rname] already has that name!</p>";
   } else {
      echo "error code $err";
   }

}
echo "<a href=\"main.php\">Return</a> to Home Page.";

} else {
   echo "<h3>You are not logged in!</h3><p> <a href=\"index.php\">Login First</a></p>";
}
?>
