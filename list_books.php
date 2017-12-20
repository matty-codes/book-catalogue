<?php

session_start();
include('structure');
call_header();

echo '
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
$conn = new PDO();
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
        book.isbn = user_book.isbn
    WHERE user_book.user_id = :user_id

';

foreach ($conn-query($sql) AS $book) {
    echo '<tr>
<td>' . $book['title'] . '</td>
<td>' . $book['authors'] . '</td>
<td>' . $book['genres'] . '</td>
<td>' . $book['year'] . '</td>
<td>' . $book['isbn'] . '</td>
</tr>
';
}
echo '</table>';
call_footer();