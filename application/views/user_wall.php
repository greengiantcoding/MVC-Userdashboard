<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$userInfo = $this->session->userdata('userInfo');

?>

<html>
<head>
	<title><?=$userInfo['first_name']?> <?=$userInfo['last_name']?>'s Wall</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/user_wall.css">
	<script type="text/javascript" src="/JQueryLib.js"></script>
	<script type="text/javascript">
	

	$(document).ready(function(){
		$('div#privateMessageDiv').hide();
		$('button#publicBtn').hide();
	});
	$(document).on('click', '#privateBtn', function(){
		$('div#privateMessageDiv').show();
		$('div#publicMessageDiv').hide();
		$('button#privateBtn').hide();
		$('button#publicBtn').show();
	});
	$(document).on('click', '#publicBtn', function(){
		$('div#publicMessageDiv').show();
		$('div#privateMessageDiv').hide();
		$('button#publicBtn').hide();
		$('button#privateBtn').show();
	})


	</script>
</head>
<body>
	<div id="container">	
		
		<div class="header">
			<h4 class="headerText">Test App</h4>
			<a href="/login/index"><button class="headerText headerHome">Home</button></a>
			<a href="/user/privateMessages/<?=$userInfo['id']?>" class="headerText" id="myMailbox">Mailbox</a>		
			<a href="/user/logout" class="headerText headerLink logoutLink">Log Out</a>
		</div><!--header-->




		<h1 id="welcomeMsg"><?=$wallInfo['first_name']?> <?=$wallInfo['last_name']?>'s Wall</h1>
		<br><br>
<?php
		if(count($wallPosts) > 0)
		{
			foreach($wallPosts as $wallPost)
			{
				// $timeStamp = 0;
?>
					<p class="postedAuthorName disp_ib"><a href="/user/wall/<?=$wallPost['user_author_id']?>"><?=$wallPost['first_name']?> <?=$wallPost['last_name']?>:</a>
					<!-- <p class="postedTimeStamp disp_ib"></p> -->
				<div class="postedBox">
					<p class="postedText"><?=$wallPost['content']?></p>
					<p class="postedLineBreak"></p>
				</div><!--postedBox-->	
				<p class="spacedLine"></p>
<?php
			}
		}
?>
	<div id="publicMessageDiv">
		<form method='POST' action='/add/post'>
			<textarea class="newPostAreA" name='newPostContent' placeholder="POST a new PUBLIC MESSAGE on <?=$wallInfo['first_name']?>'s wall ..."></textarea>
			<input type='hidden' name='postAuthorId' value='<?=$userInfo['id']?>'>
			<input type='hidden' name='wallId' value='<?=$wallInfo['id']?>'>
			<input type='submit' value='Post' id="newPostBtn">
		</form>
	</div><!--publicBtnDiv-->
		<button id="privateBtn" class="swapBtn">Switch To Private Message</button>
	<div id="privateMessageDiv">
		<form method='POST' action='/private/message'>
			<textarea class="newPostAreA" name='newMessageContent' placeholder='SEND a new PRIVATE MESSAGE for <?=$wallInfo['first_name']?> here...'></textarea>
			<input type='hidden' name='messageAuthorId' value='<?=$userInfo['id']?>'>
			<input type='hidden' name='messageWallId' value='<?=$wallInfo['id']?>'>
			<input type='submit' value='Send' id="newPostBtn">
		</form>
	</div><!--privateMessageDiv-->
		<button id="publicBtn" class="swapBtn">Switch To Public Message</button>

	</div><!--container-->
</body>
</html>







<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
<div id="var_dump_notes">
<?php

var_dump($wallInfo);
 echo "-----userInfo------";
var_dump($userInfo);
 echo "-----wallpost------";
var_dump($wallPosts);
 echo "-----session userdata------";
var_dump($this->session->userdata());
?>
</div>