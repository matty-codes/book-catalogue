<?php 
function call_header() {
    echo '<html><head></head><body>
<div id="head">
';
    if (isset($_SESSION['logged']) && ($_SESSION['logged'] == true)) {
        echo '<a href="index.php?logout=1">Log out</a>';
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