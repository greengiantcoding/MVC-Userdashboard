<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($this->session->userdata('userEPcombo'))
{
	$this->session->unset_userdata('userEPcombo');
}

$userInfo = $this->session->userdata('userInfo');

?>


<html>
<head>
	<title>User Dashboard</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/user_catalog.css">
	<script type="text/javascript" src="/JQueryLib.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('div#uploadProfilePic').hide();
		})
		$(document).on('click', '#showUploadPic', function(){
			$('div#uploadProfilePic').show();
		})
	</script>
</head>
<body>
	<div class="container">
		<div class="header">
			<h4 class="headerText">Test App</h4>
			<a href="/login/index"><button class="headerText headerHome">Home</button></a>
			<a href="/user/privateMessages/<?=$userInfo['id']?>" class="headerText" id="myMailbox">Mailbox</a>
			<a href="/user/wall/<?=$userInfo['id']?>" id="myWall" class=
			"headerText">My Wall</a>
			<a href="/user/logout" class="headerText headerLink logoutLink">Log Out</a>
		</div><!--header-->
		<br>
		<h2>Hello <?=$userInfo['first_name']. " " . $userInfo['last_name']?></h2><br>
		<h3>Thanks for being a member since: <?=$userInfo['created_at']?></h3>
		<br><br>
		<br><br>
		<br><br>
		<h3 id="others">Other Members</h3>
		<div class="userDash">
			<table>
				<thead>
					<tr class="underlineRow">
						<td class="userContent centered">ID</td>
						<td class="userContent centered">Member Name</td>
						<td class="userContent centered">Email Address</td>
						<td class="userContent centered">Member Since</td>
						<td class="userContent centered">User Rights</td>
<?php
						if($userInfo['rights'] == 'Admin')
						{
?>
						<td class="userContent centered">Actions</td>
<?php
						}
?>
					</tr>
				</thead>
				<tbody>
<?php
				if($this->session->userdata('listOfUsers'))
					$listOfUsers = $this->session->userdata('listOfUsers');
					for($i=0; $i < count($listOfUsers); $i++)
					{
						if($i % 2)
						{
?>
					<tr class="boxedIn">
						<td class="userContent centered boxedIn"><?=$listOfUsers[$i]['id']?></td>
						<td class="userContent boxedIn"><a href="/user/wall/<?=$listOfUsers[$i]['id']?>"><?=$listOfUsers[$i]['first_name']?> <?=$listOfUsers[$i]['last_name']?></a></td>
						<td class="userContent boxedIn"><?=$listOfUsers[$i]['email']?></td>
						<td class="userContent boxedIn"><?=$listOfUsers[$i]['created_at']?></td>
						<td class="userContent centered boxedIn"><?=$listOfUsers[$i]['rights']?></td>
<?php
						if($userInfo['rights'] == 'Admin')
						{
?>
						<td class="userContent centered boxedIn">
							<a href="/edit/user/<?=$listOfUsers[$i]['id']?>">Edit</a>
							<a href="/remove/user/<?=$listOfUsers[$i]['id']?>">Remove</a>
						</td>
<?php
						}						
?>						
					</tr>
<?php
						}
						else
						{
?>
					<tr class="boxedIn">
						<td class="userContent centered boxedIn bgGray"><?=$listOfUsers[$i]['id']?></td>
						<td class="userContent boxedIn bgGray"><a href="/user/wall/<?=$listOfUsers[$i]['id']?>"><?=$listOfUsers[$i]['first_name']?> <?=$listOfUsers[$i]['last_name']?></a></td>
						<td class="userContent boxedIn bgGray"><?=$listOfUsers[$i]['email']?></td>
						<td class="userContent boxedIn bgGray"><?=$listOfUsers[$i]['created_at']?></td>
						<td class="userContent centered boxedIn bgGray"><?=$listOfUsers[$i]['rights']?></td>
<?php
						if($userInfo['rights'] == 'Admin')
						{
?>
						<td class="userContent centered boxedIn bgGray">
						<a href="/edit/user/<?=$listOfUsers[$i]['id']?>">Edit</a>
						<a href="/remove/user/<?=$listOfUsers[$i]['id']?>">Remove</a>
						</td>
<?php
						}						
?>
					</tr>
<?php
						}
					}
?>
				</tbody>
			<table>

			<br><br><br>
			<button id="showUploadPic">Upload A Profile Pic!</button>
			<div id="uploadProfilePic">
				<form action="/profile/picUpload/<?=$userInfo['id']?>" method="post" enctype="multipart/form-data">
					<fieldset>
						<legend>Upload Profile Pic</legend>
						<br />
						<label for="userFile">My Picture: </label>
						<input type="file" size="40" name="userFile" id="userFile"/><br />
						<br />
						<label for="altName">Name of image</label>
						<input type="text" size="30" name="altName" id="altName"/><br />
						<br />
						<input type="submit" value="Upload File" />
					</fieldset>
				</form>	
			</div><!--uploadProfilePic-->
		</div><!--userDash-->
	</div><!--container-->
</body>
</html>