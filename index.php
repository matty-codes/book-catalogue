<?php

session_start();
if (isset($_GET['logout'])) {
	session_destroy();
}
include('structure.php');

if (isset($_SESSION['logged']) && ($_SESSION['logged'] === true)) {
	header('Location: home.php');
}

if (isset($_POST['username']) && (isset($_POST['password']))) {

	// @todo: set up local mysql server, create example users (complete setup script)
    $dsn = 'mysql:dbname=book_catalogue;host=localhost';
    $user = 'root';
    $password = 'toor';
    
    try {
        $conn = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
/*	$stmt = $conn->prepare('
		SELECT
			username,
			password,
			access_level
		FROM
			users
		WHERE
			username = :username
		AND
			password = :password;
	');
	$stmt->bindParam(':username', $_POST['username']);
	$stmt->bindParam(':password', $_POST['password']);
	$stmt->execute();
	$user = $stmt->fetchAll(); */
	$return = true;
	// if ($user) {
	if ($return) {
		$_SESSION['logged'] = true;
		// $_SESSION['user'] = $user['access_level'];
		if ($_POST['username'] == 'admin') {
    		$_SESSION['user'] = 'admin';
		} else {
		    $_SESSION['user'] = 'user';
		}
//		$_SESSION['username'] = $user['username'];
        $_SESSION['username'] = $_POST['username'];
		header('Location: home.php');
	} else {
		echo 'Error. Check username and password.';
	}
}

call_header();
?>
<h1>Login</h1>

<form action="index.php" method="POST">
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" />
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" />
	<input type="submit" value="Submit" />
</form>

<?php
call_footer();