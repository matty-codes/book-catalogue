<?php 
function call_header() {
	echo '
<html>
	<head>
	</head>
	<body>
		<div id="head" width="1000px" height="200px">
            <ul><li>
';
	if (isset($_SESSION['logged']) && ($_SESSION['logged'] == true)) {
		echo '<a href="index.php?logout">Log out</a>';
	} else {
		echo '<a href="index.php">Log in</a>';
	}
	echo '</li>';
	if (isset($_SESSION['user'])) {
    	if ($_SESSION['user'] == 'admin') {
	       echo '<li><a href="add_book.php">Add Book</a></li>';
	   }
    	echo '<li><a href="mark_read.php">Mark Books as Read</a></li>';
	   echo '<li><a href="list_books.php">View Books</a></li>';
	}
	echo '</div>';
}

function call_footer() {
	echo '</body></html>';
}
