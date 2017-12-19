<?php 
function call_header() {
	echo '
<html>
	<head>
	</head>
	<body>
		<div id="head" width="1000px" height="200px" style="width: 1000px; height: 200px; border: 1px solid #f00;">
';
	if (isset($_SESSION['logged']) && ($_SESSION['logged'] == true)) {
		echo '<a href="index.php?logout">Log out</a>';
	} else {
		echo '<a href="index.php">Log in</a>';
	}
	echo '
</div>
';
}

function call_footer() {
	echo '</body></html>';
}