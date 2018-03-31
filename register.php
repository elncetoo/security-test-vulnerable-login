<?php

	require_once('dbcon.php');
	$msg = "";
	$errors = array();
		
	if(!empty($_POST['un']) && !empty($_POST['pw'])) {
		
		$un = $_POST['un'];
		$pw = $_POST['pw'];

		$user_check_query = "SELECT * FROM reg_users WHERE un='$un' OR pw='$pw' LIMIT 1";
		  $result = mysqli_query($conn, $user_check_query);
		  $user = mysqli_fetch_assoc($result);
		  
		  if (count($errors) == 0) {

		  	$query = "INSERT INTO reg_users (un, pw) 
		  			  VALUES('$un', '$pw')";
		  	mysqli_query($conn, $query);
		  	$_SESSION['username'] = $username;
		  	header('location: login.php');
		  } else {
		  	$msg= 'Try again..';
		  }
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
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    	<input name="un" type="text" placeholder="Username" required /><br/>
    	<input name="pw" type="password" placeholder="Password"  required/><br/>
    	<input type="submit" name="submit" value="Create user" /><br/>
	</form><br/>
		<?php if(!empty($msg)): ?>
		<h3><?= $msg ?></h3>
		<?php endif; ?>
	</div>

	<footer>
		<p>Copenhagen Business Academy Project - Svilena Koleva - Web Development 2018 </p>
	</footer>	
</body>
</html>
