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
	$error = array();

	$un = filter_input(INPUT_POST, 'un', FILTER_SANITIZE_SPECIAL_CHARS) 
		or die('Missing/illegal username parameter');
	$pw = filter_input(INPUT_POST, 'pw', FILTER_SANITIZE_SPECIAL_CHARS)
		or die('Missing/illegal password parameter');

	$uppercase = preg_match('@[A-Z]@', $pw);
	$lowercase = preg_match('@[a-z]@', $pw);
	$number = preg_match('@[0-9]@', $pw);


	if(!$uppercase || !$lowercase || !$number || !ctype_alnum($pw) || strlen($pw) < 8) {

    $msg = "<p>The password must be 8 characters long, to contain at least 1 lowercase letter, 1 uppercase letter and 1 number.</p>";
} else {
	//the salt here is randomly generated and in this case, we want to increase the default cost for BCRYPT to 11	
	$salt = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)];
	$pwhash = password_hash($pw, PASSWORD_BCRYPT, $salt);
	$msg='';
	
	require_once('dbcon.php');
	$sql = 'INSERT INTO users (un, pwhash, salt) VALUES (?, ?, ?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sss', $un, $pwhash, $salt);
	$stmt->execute();
	
	if($stmt->affected_rows > 0){
		$msg = "User $un created :)";
	}
	else {
		$msg = "Could not create $un, try again.";
	}
}
}
?>

<div class="container">
	<h1>Security Test</h1>
	<p>SQL Injection (MySQL vulnarable)</p>
	<div class="form">
		<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" >
    	<input name="un" type="text" placeholder="Username" required autocomplete="Off" /><br/>
    	<input name="pw" type="password" placeholder="Password"  required autocomplete="Off"/><br/>
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