<?php
	ob_start();
?>
<!doctype html>
<html lang="en">
<head> 	<meta charset="utf-8"> 	<title>Login</title>
</head>
<body>
<h1>Login</h1>
<?php 
session_start();
session_unset();
$file =  'users/users.txt';
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
	$loggedin = FALSE; 
	ini_set('auto_detect_line_endings', 1);
	$fp = fopen($file, 'rb');
	while ( $line = fgetcsv($fp, 200, "\t") ) {
		if ( ($line[0] == $_POST['username']) AND (password_verify($_POST['password'], $line[1]))) {
			$loggedin = TRUE;
			break;
		}
	} 
	fclose($fp); 
	if ($loggedin) {
		date_default_timezone_set("Asia/Bangkok");
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['loggedin'] = date("l jS \of F Y h:i:s A");
		header('Location: welcome.php');
		ob_end_flush();
	} else {
		print '<p style="color: red;">The username and password you entered do not match those on file.</p>';	
	}	
}else{
?>
<form action="login.php" method="post">
	<p>Username: <input type="text" name="username" size="20"></p>
	<p>Password: <input type="password" name="password" size="20"></p>
	<input type="submit" name="submit" value="Login">
</form>
<?php } 
;
?>
</body>
</html>

