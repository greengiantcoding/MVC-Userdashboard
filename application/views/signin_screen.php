<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<html>
<head>
	<title>Sign In Page</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/signin_screen.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<h4 class="headerText">Test App</h4>
			<a href="/user/logout"><button class="headerText headerHome">Home</button></a>
			<a href="/login/signin" class="headerText headerLink signinLink">Sign In</a>
		</div><!--header-->
		<div class="signin">
			<h4 class="signinTitle">Sign In</h4>
			<form method='POST' action='/signin/user'>
				<label>Email Address:</label>
				<input type='email' name='email'>
				<label>Password:</label>
				<input type='password' name='password'>
				<input type='submit' value='Sign In' class='signinBtn'>
			</form>
			<br><br>
			<a href="/signin/register" class="registerText">Don't have an account? Register</a>
		</div><!--signin-->
	</div><!--container-->
</body>
</html>