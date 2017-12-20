<?php 
session_start();
include('structure.php');

if ($_SESSION['logged'] != true) {
	header('Location: index.php');
}
call_header();
echo '<p>Welcome, ' . $_SESSION['username'] . '.</p>';
if ($_SESSION['user'] == 'admin') {
    echo '<p>As an administrator, you can add books to the collection. You can also perform standard user activities, such as marking a book as read.</p>';
}

call_footer();
