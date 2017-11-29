<?php
session_start();
ini_set('display_errors', 1);
include_once "config.php";
include_once "functions/login.php";
include_once "functions/checkUser.php";
include_once "functions/sendMail.php";
include_once "functions/prepare.php";
include_once "functions/createUser.php";

include_once "functions/imageUpload.php";
include_once "functions/listImages.php";
include_once "functions/comment.php";


if (isset($_POST["uoe"]) && isset($_POST["password"])) {
	// echo "UOE AND PASSWORD IS SET";
    if(login($_POST["uoe"], $_POST["password"])) {
        $_SESSION["loggedIn"] = true;
        echo '<meta http-equiv="refresh" content="0;URL=\'mainpage.php\'" />';
    } else {
        // echo "Your username/email and/or password is incorrect.";
        echo '<script>window.onload = function() {clmsg("<p>Your username/email and/or password is incorrect</p><p>Or your account is not verified.</p>");};</script>';
    }
}

if (isset($_POST["logout"])) {
    logout();
    // echo "You logged out";
}



// REGISTER

if (isset($_POST["register_username"]) && isset($_POST["register_email"]) && isset($_POST["register_password"])) {
    // var_dump($_POST);
    $cuser = createUser($_POST["register_username"], $_POST["register_password"], $_POST["register_email"]);
    // var_dump($cuser);
    if ($cuser == true) {
        echo '<script>window.onload = function() {clmsg("<span style=\"color: green;\"><p>You registered Successfuly.</p><p> An email has been send to activate your account.</p></span>");};</script>';
    } else {
        echo '<script>window.onload = function() {clmsg("<p>An account with that username/email already exists.</p>");};</script>';
    }

}
?>
