<?php
if (isset($_POST["commentText"])) {
    createComment($_SESSION["usr"], strip_tags($_POST["commentText"]), $_POST["imgid"]);
}
function createComment($user, $text, $img) {
    $conn = SQL('instaclone');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = 'UPDATE `imagedata` SET `Comments` = concat(Comments, (?)) WHERE id = (?)';

    $stmt = createPrepare($conn, $query, 'ss', [",".$user."#%#^".$text, $img]);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    ///////////////////////////

    $conn = SQL('instaclone');
    $query = "SELECT * FROM `users` WHERE `username` = (?) AND `subscription` = '1'";
	$sql = $conn->prepare($query);

	$sql->bind_param("s", $_SESSION["usr"]);
	$sql->execute();
	$result = $sql->get_result();
	$res = $result->fetch_array(MYSQLI_BOTH);

    $subscriptionBody = '<h1>'.$_SESSION["usr"].' commented on your photo: <br><br><br><b>'.$_SESSION["usr"].': '.strip_tags($_POST["commentText"]).'<b></h1>';
    $subscriptionBodyAlt = "".$_SESSION["usr"]." commented on your photo: \n\n\n ".$_SESSION["usr"].": ".strip_tags($_POST["commentText"])."";

    sendMail($res["email"], $subscriptionBody, $subscriptionBodyAlt, "Someone commented on a photo of you");
    // echo $subscriptionBody;
}

?>
