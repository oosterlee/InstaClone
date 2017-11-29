<?php

function login($uoe, $password) {
    // uoe = UsernameOrEmail.

    $conn = SQL('instaclone');
    $query = "SELECT * FROM `users` WHERE (`username` = (?) OR `email` = (?)) AND `password` = (?) AND `verified` = 'true'";
	$sql = $conn->prepare($query);

    $encPass = encrypt($password);

	$sql->bind_param("sss", $uoe, $uoe, $encPass);
	$sql->execute();
	$result = $sql->get_result();
	$res = $result->fetch_array(MYSQLI_ASSOC);
    if (count($res) > 0) {
        $_SESSION["usr"] = $res["username"];
        $_SESSION["loggedIn"] = true;
        return true;
    } else {
        return false;
    }
}
function logout() {
    $_SESSION["loggedIn"] = false;
    return true;
}


function encrypt($str) {
    return crypt($str, sha1(md5($str)));
}

?>
