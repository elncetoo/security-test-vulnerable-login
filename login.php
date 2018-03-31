<?php 
session_start(); 
require('dbcon.php');

if (isset($_POST['submit'])){

	$un = $_POST['un'];
	$pw = $_POST['pw'];

	$query = "SELECT id,un,pw FROM `reg_users` WHERE un='$un' and pw='$pw'";
	 
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	$count = mysqli_num_rows($result);

		if ($count == 1){
		$_SESSION['username'] = $un;
		}else{

		$msg = "Invalid Login Credentials.";
		}
}

if (isset($_SESSION['username'])){
$un = $_SESSION['username'];
header("Location: secret.php");
 
}else{

	echo "This is the Members Area, log in first..";
	
}


?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8">
        <title>Security Mandatory 2</title>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
<body>
	<div class="container">
	<h1>Security Test</h1>
	<p>SQL Injection (MySQL vulnarable)</p>
	<div class="form">
		<form action="login.php" method="post">
    	<input name="un" type="text" placeholder="Username" /><br/>
    	<input name="pw" type="password" placeholder="Password" /><br/>
    	<input type="submit" name="submit" value="Login" /><br/>
	</form><br/>
	<div>
		<?php if(!empty($msg)): ?>
		<h3><?= $msg ?></h3>
		<?php endif; ?>
	</div>
	</div>	
	<footer>
		<p>Copenhagen Business Academy Project - Svilena Koleva - Web Development 2018 </p>
	</footer>
</body>
</html>
