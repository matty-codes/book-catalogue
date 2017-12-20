<?php

session_start();
error_reporting(-1);
include('structure.php');
error_reporting(-1);
call_header();
error_reporting(-1);
echo '
<style>
td {
	border: 1px solid #000;
}
</style>
<table>
<tr>
<th>Title</th>
<th>Author(s)</th>
<th>Genre(s)</th>
<th>Release Year</th>
<th>ISBN</th>
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
$sql = '
    SELECT
        book.isbn,
        book.title,
        book.author,
        book.genre,
        book.year,
        user_book.is_read
    FROM
        book
    LEFT JOIN
        user_book
    ON
        (book.isbn = user_book.isbn) AND (user_book.user_id = ' . $_SESSION['user_id'] . ')

';

foreach ($conn->query($sql) AS $book) {
	echo '<tr>
<td>' . $book['title'] . '</td>
<td>' . $book['author'] . '</td>
<td>' . $book['genre'] . '</td>
<td>' . $book['year'] . '</td>
<td>' . $book['isbn'] . '</td>
<td>' . $book['is_read'] . '</td>
</tr>
';
}
echo '</table>';
call_footer();
