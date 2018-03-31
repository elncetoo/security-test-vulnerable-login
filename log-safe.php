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
	<?php
	if(filter_input(INPUT_POST, 'submit')){
		$un = filter_input(INPUT_POST, 'un') 
			or die('Missing/illegal un parameter');
		$pw = filter_input(INPUT_POST, 'pw')
			or die('Missing/illegal pw parameter');

		require_once('dbcon.php');
		$sql = 'SELECT id, pwhash FROM users WHERE un=?';
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s', $un);
		$stmt->execute();
		$stmt->bind_result($uid, $pwhash);
		
		while($stmt->fetch()) { }
		
		if (password_verify($pw, $pwhash)){
			//echo 'Logged in as '.$un;
			$_SESSION['uid'] = $uid;
			$_SESSION['username'] = $un;
			header("Location: secret.php");
			
		}
		else{
			echo 'Illegal username/password combination';
		}
		echo '<hr>';
	}
		
	?>
	<div class="container">
	<h1>Security Test</h1>
	<p>SQL Injection (MySQL vulnarable)</p>
	<div class="form">
		<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
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
