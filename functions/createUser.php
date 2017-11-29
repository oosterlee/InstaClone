<?php

function createUser($username, $password, $email) {
    // var_dump(checkUser($username, $password, $email));
    if (checkUser($username, $password, $email)[0] == false) {
        return false;
    }

    $conn = SQL('instaclone');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = 'INSERT INTO `users` (`username`, `password`, `email`, `date`, `code`) VALUES ((?), (?), (?), CURRENT_TIMESTAMP(), "1")';

    $stmt = createPrepare($conn, $query, 'sss', [$username, encrypt($password), $email]);
    $stmt->execute();

    ///////////////////////////

    $conn = SQL('instaclone');
    $query = "SELECT * FROM `users` WHERE `username` = (?) OR `email` = (?)";
	$sql = $conn->prepare($query);

	$sql->bind_param("ss", $username, $email);
	$sql->execute();
	$result = $sql->get_result();
	$res = $result->fetch_array(MYSQLI_BOTH);
    $verificationBody = "<h1>Verificate your email.</h1><p>Your email has been requested to verify your email address.</p><br></br><p>Please click <a href=\"http://".$_SERVER["HTTP_HOST"]."/".$_SESSION["dirname"]."/verification.php?code=".$res["code"]."\">this link</a></p><br><br><br><p>If that link does not work copy and paste this link: http://".$_SERVER["HTTP_HOST"]."/".$_SESSION["dirname"]."/verification.php?code=".$res["code"]."</p>";
    $verificationBodyAlt = "Copy and paste this link: http://".$_SERVER["HTTP_HOST"]."/".$_SESSION["dirname"]."/verification.php?code=".$res["code"]." to verify your account.";
    sendMail($email, $verificationBody, $verificationBodyAlt, "Please verify your email");
    // if (count($res) > 0) {
    //     return true;
    // } else {
    //     return false;
    // }
    return true;
}

?>
