<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$userInfo = $this->session->userdata('userInfo');
?>

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/assets/css/mailbox.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<h4 class="headerText">Test App</h4>
			<a href="/login/index"><button class="headerText headerHome">Home</button></a>
			<a href="/user/wall/<?=$userInfo['id']?>" id="myWall" class=
			"headerText">My Wall</a>
		
			<a href="/user/logout" class="headerText headerLink logoutLink">Log Out</a>
		</div><!--header-->

		<div class="messages">
		<h2><?=$userInfo['first_name']?> <?=$userInfo['last_name']?>'s MailBox</h2>
<?php
		if(count($privateMessages) > 0)
		{
			foreach($privateMessages AS $message)
			{
?>
				<div class="messageBox">
					<a href="/user/wall/<?=$message['user_author_id']?>"><?=$message['first_name']?> <?=$message['last_name']?></a>
<!-- 					<p class="messageFrom"><?=$message['first_name']?> <?=$message['last_name']?></p>
 -->					<p class="messageTime"><?=$message['created_at']?></p>
					<p class="messageContent"><?=$message['content']?></p>
				</div>
<?php
			}
		}
?>



		</div><!--messages-->
	</div><!--container-->		
</body>
</html>




<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>

<?php
echo "---------privateMessages-----------";
var_dump($privateMessages);
echo "---------Session userdata-----------";
var_dump($this->session->userdata());
?>