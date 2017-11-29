<?php

function checkUser($username, $password, $email) {
    $arr = array();
    if (preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/", $email)) {
        array_push($arr, true);
    } else {
        array_push($arr, false);
    }

    if (strlen($username) > 30) {
        array_push($arr, false);
    } else {
        array_push($arr, true);
    }

    array_push($arr, checkDatabaseExists($username, $email));

    return [!in_array(false, $arr), $arr];
}

function checkDatabaseExists($username, $email) {

    $conn = SQL('instaclone');
    $query = "SELECT * FROM `users` WHERE `username` = (?) OR `email` = (?)";
	$sql = $conn->prepare($query);

	$sql->bind_param("ss", $username, $email);
	$sql->execute();
	$result = $sql->get_result();
	$res = $result->fetch_array(MYSQLI_BOTH);

    if (count($res) > 0) {
        return false;
    } else {
        return true;
    }
}


?>
