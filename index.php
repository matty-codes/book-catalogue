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

    // @todo: set up local mysql server, create example users
/*    $conn = new PDO($pdo_server, $pdo_username, $pdo_password);
    $stmt = $conn->prepare('
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
    */
    $return = true;
    if ($return) {
        $_SESSION['logged'] = true;
        $_SESSION['user'] = 'admin';
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