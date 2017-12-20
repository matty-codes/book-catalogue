<?php

session_start();
error_reporting(-1);
include('structure.php');
error_reporting(-1);
call_header();
error_reporting(-1);
    $dsn = 'mysql:dbname=book_catalogue;host=127.0.0.1';
    $user = 'root';
    $password = 'toor';
    
    try {
        $conn = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
$sql = '
	SELECT
		book.isbn,
		book.title,
		book.author,
		book.genre,
		book.year,
		user_book.id AS user_book_id,
		user_book.is_read
	FROM
		book
	LEFT JOIN
		user_book
	ON
	(book.isbn = user_book.isbn) AND (user_book.user_id = ' . $_SESSION['user_id'] . ');';
 $books = $conn->query($sql);

if (isset($_POST['submit'])) {
	$dsn = 'mysql:dbname=book_catalogue;host=127.0.0.1';
	$user = 'root';
	$password = 'toor';

	try {
		$conn = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}
	echo '<br />POST: ' . print_r($_POST, true);
	foreach($_POST AS $item) {
	$sql2 = '
		UPDATE
			user_book
		SET
			is_read = "'.$_POST[''].'"
		WHERE
			id='.$_POST[''].'
	';

	}
}
echo '
<style>
td {
	border: 1px solid #000;
}
</style>
<form action="mark_read.php" method="post">
<table>
<tr>
<th>Title</th>
<th>Author(s)</th>
<th>Read?</th>
</tr>
';
    $dsn = 'mysql:dbname=book_catalogue;host=127.0.0.1';
    $user = 'root';
    $password = 'toor';
    
    try {
        $conn = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

foreach ($books AS $key=>$book) {
	echo '<tr>
<td>' . $book['title'] . '</td>
<td>' . $book['author'] . '</td>
<td><input type="checkbox" name="' . $book['user_book_id'] . '" ';
	if ($book['is_read'] == 1) {
		echo 'checked="checked" ';
	}
	echo '/></td>
</tr>
';
}
echo '</table>
<input type="submit" />
</form>';
call_footer();
