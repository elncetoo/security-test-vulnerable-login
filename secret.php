<?php session_start(); ?>

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
		<h1>Welcome, <span><?php echo $_SESSION['username']; ?></span></h1>
		<p>You are now logged in!</p>
		<h3><a style="text-decoration: none;" href="logout.php">Logout?</a></h3>
        <img src="two-thumbs-up.jpg" alt="buble" style="width:25%;height:auto;">
      	<br /><br />
	</div>	
	<footer>
		<p>Copenhagen Business Academy Project - Svilena Koleva - Web Development 2018 </p>
	</footer>
</body>
</html>
