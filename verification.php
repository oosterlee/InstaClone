<?php
include_once "main.php";
if (isset($_GET["code"])) {
    if ($_GET["code"] == "") {
        echo "<h1>No code is entered.</h1>";
    } else {
        $conn = SQL('instaclone');
        $query = "SELECT * FROM `users` WHERE `code` = (?)";
    	$sql = $conn->prepare($query);

    	$sql->bind_param("s", $_GET["code"]);
    	$sql->execute();
    	$result = $sql->get_result();
    	$res = $result->fetch_array(MYSQLI_ASSOC);
        if (count($res) > 0) {

            $query = "UPDATE `users` SET `verified`='true' WHERE `code` = (?)";
        	$sql = $conn->prepare($query);

        	$sql->bind_param("s", $_GET["code"]);
        	$sql->execute();

            echo "<h3>Your code was valid and your account is verified. You will get redirected to the login page.</h3>";
            echo '<meta http-equiv="refresh" content="2;URL=\'index.php\'" />';
        } else {
            echo "<h1>The code is not valid.</h1>";
        }
    }
} else {
    echo "<h1>No code is entered.</h1>";
}

?>
