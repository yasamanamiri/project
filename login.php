
<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{

$username=$_POST['username'];
$password=$_POST['password'];

$connection = mysqli_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($connection,$username);
$password = mysqli_real_escape_string($connection,$password);
// Selecting Database
$db = mysqli_select_db($connection,"company");
// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($connection,"select * from login where password='$password' AND username='$username'");
$rows = mysqli_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($connection); // Closing Connection
}
}
?>
