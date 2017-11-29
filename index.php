<!DOCTYPE html>
<html>
<head>
    <?php include_once "main.php"; $_SESSION["dirname"] = basename(__DIR__); ?>
	<title>InstaClone - Login</title>
	<link rel="stylesheet" type="text/css" href="./login.css">
	<script type="text/javascript" src="./login.js"></script>
	<!-- <script type="text/javascript" src="./customDialog.js"></script> -->
</head>
<body>
	<div id="page_wrapper">
		<div id="login_block" class="center" style="display: block;">
		<h1>Login</h1>
			<div id="login">
                <p style="color: red;" id="login_message"></p>
				<form action="index.php" method="POST">
					<input type="username" name="uoe" class="username_login input" placeholder="Username" required="true" />
					<input type="password" name="password" class="password_login input" placeholder="Password" />
					<input type="submit" name="submit_login" class="button_login" value="Login" />
					<p class="text_login">Not registered? <a class="text_login_register" href="#register=true&amp;login=false">Register an account</a></p>
				</form>
			</div>
		</div>
		<div id="register_block" class="center" style="display: none;">
		<h1>Register</h1>
			<div id="register">
                <p style="color: red;" id="register_message"></p>
				<form action="index.php" method="POST">
					<input type="username" name="register_username" class="username_register input" placeholder="Username *" required="true" />
					<input type="email" name="register_email" class="email_register input" placeholder="Email *" required="true" />
					<input type="password" name="register_password" class="password_register input" placeholder="Password *" required="true" />
                    <p>Email if someone comments (Email subscription)<input type="checkbox" name="register_checkbox" value="subscribe" checked style="width: 15px; height: 15px;"></p>
					<a href="#login=true&amp;register=false" class="text_login_register"><input type="submit" name="submit_register" class="button_register" value="Register" /></a>
					<p class="text_login">Already have an account? <a class="text_login_register" href="#login=true&amp;register=false">Login</a></p>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
