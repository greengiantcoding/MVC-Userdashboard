<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
	<title>Register Page</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/register_screen.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<h4 class="headerText">Test App</h4>
			<a href="/login/index"><button class="headerText headerHome">Home</button></a>
			<a href="/login/signin" class="headerText headerLink signinLink">Sign In</a>
		</div><!--header-->
		<div class="registerBox">
			<h4 class="registerTitle">Register</h4>
			<form method='POST' action='/register/user'>
				<label>Email Address:</label>
				<input type='email' name='email'>
				<label>First Name:</label>
				<input type='text' name='firstName'>
				<label>Last Name:</label>
				<input type='text' name='lastName'>
				<label>Password:</label>
				<input type='password' name='password'>
				<label>Password Confirmation:</label>
				<input type='password' name='confirmPassword'>
				<input type='submit' value='Register' class='registerBtn'>
			</form>
		</div><!--registerBox-->
<?php
		if($this->session->userdata('errors'))
		{
			$errors = $this->session->userdata('errors');
?>
		<div class='errorBox'>
<?php
			foreach($errors AS $error)
			{
?>
				<p class="errorText"><?=$error?></p>
<?php
			}
			$this->session->unset_userdata('errors');
?>
		</div><!--errorBox-->
<?php
		}
?>
	</div><!--container-->
</body>
</html>