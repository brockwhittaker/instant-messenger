<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Instant Messenger | Lavancier</title>
		<link rel="stylesheet" type="text/css" href="instant-messenger-stylesheet.css">
		<style>

		</style>
	</head>
	<body>
		<div id='choose-user'>
		    <input type='text' name='username' class='username-input' placeholder='username'></input>
		</div>
		<input type='text' name='response' class='response' placeholder='write message here'></input>
		<div id='messages'></div>
		<div id='display-username' style='display:none'>You are </div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="comments-script.js" type="text/javascript"></script>
	</body>
</html>
<!-- when updating $.get(), make sure to do on post, on load, and on setInterval -->
