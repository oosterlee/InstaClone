<?php
function SQL($dbname) {
    $host = "localhost";
    $usr = "instaclone";
    $psw = "gu15ifx0kQ4usqoK";

    return new mysqli($host, $usr, $psw, $dbname);
}

?>
