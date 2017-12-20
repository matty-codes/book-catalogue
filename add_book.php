<?php

session_start();
error_reporting(-1);
include('structure.php');
error_reporting(-1);
call_header();
error_reporting(-1);
print_r($_POST);
if (isset($_POST['isbn'])) {
    $dsn = 'mysql:dbname=book_catalogue;host=127.0.0.1';
    $user = 'root';
    $password = 'toor';
    
    try {
        $conn = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
	$sql = '
		INSERT INTO book(isbn, title, author, genre, year) VALUES ("' . $_POST['isbn'] . '", "' . $_POST['title'] . '", "' . $_POST['author'] . '", "' . $_POST['genre'] . '", "' . $_POST['year'] . '");
	';
	$conn->exec($sql);
	$sql = 'SELECT id FROM users';
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo '<br />IDS: ' . print_r($ids, true);
	foreach ($ids AS $id) {
		$sql = 'INSERT INTO user_book (isbn, user_id, is_read) VALUES ("'.$_POST['isbn'].'","'.$id['id'].'",0);';
		echo '<br />SQL: ' . $sql;
		$stmt = $conn->prepare($sql);
		$stmt->execute();
	}
}
echo '<form method="post" action="add_book.php">
<table>
<tr>
<td>ISBN:</td>
<td><input type="text" name="isbn" /></td>
</tr>
<tr>
<td>Title:</td>
<td><input type="text" name="title" /></td>
</tr>
<tr>
<td>Author:</td>
<td><input type="text" name="author" /></td>
</tr>
<tr>
<td>Genre:</td>
<td><input type="text" name="genre" /></td>
</tr>
<tr>
<td>Year:</td>
<td><input type="text" name="year" /></td>
</tr>
</table>
<input type="submit" />
</form>
';
call_footer();
