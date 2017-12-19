<?php 
session_start();
include('structure.php');

if ($_SESSION['logged'] != true) {
	header('Location: index.php');
}
call_header();
switch ($_SESSION['user']) {
case 'admin':
	include('admin_home.php');
break;
case 'user':
	include('user_home.php');
	break;
case 'master':
	include('master_home.php');
	break;
default:
	header('Location: index.php?logout=1');
}
call_footer();