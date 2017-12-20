<?php
error_reporting(-1);
session_start();
if (isset($_GET['logout'])) {
	session_destroy();
}
include('structure.php');
error_reporting(-1);

if (isset($_SESSION['logged']) && ($_SESSION['logged'] === true)) {
	header('Location: home.php');
}

if (isset($_POST['username']) && (isset($_POST['password']))) {
	
	// @todo: set up local mysql server, create example users (complete setup script)
	$dsn = 'mysql:dbname=book_catalogue;host=127.0.0.1';
	$user = 'root';
	$password = 'toor';
	
	try {
		$conn = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}
	$stmt = $conn->prepare('
		SELECT
			id,
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
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($user) {
		$_SESSION['logged'] = true;
		$_SESSION['user'] = $user['access_level'];
		$_SESSION['username'] = $user['username'];
		$_SESSION['user_id'] = $user['id'];
		header('Location: home.php');
	} else {
		echo '<br />Error. Check username and password.';
	}
}

call_header();
?>
<h1>Login</h1>

<form action="index.php" method="POST">
	<label for="username">Username:</label>
	<input type="text" id="username" name="username" />
	<br /><br />
	<label for="password">Password:</label>
	<input type="password" id="password" name="password" />
	<br /><br />
	<input type="submit" value="Submit" style="margin-left: 100px;" />
</form>

<?php
call_footer();
