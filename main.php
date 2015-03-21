<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Instant Messenger | Lavancier</title>
		<style>
			body {
			    background-color: #F0F6F5;
			    font-family: Helvetica Neue, Roboto, Sans-Serif;
			    font-size: 12pt;
			    font-weight: 100;
			}
			input {
			    border: none;
			    outline: none;
			    width: 100vw;
			    height: 30px;
			    position: fixed;
			    bottom: 0px;
			    left: 0px;
			    font-family: Helvetica Neue, Roboto, Sans-Serif;
			    font-size: 12pt;
			    font-weight: 200;
			    background-color: rgba(255, 255, 255, 1);
			    color: black;
			    transition: all 0.2s ease;
			}
			input:hover {
			    background-color: rgba(20, 20, 20, 0.7);
			    color: white;
			}
			#messages {
			    width: 100vw;
			    height: auto;
			    margin-bottom: 10vh;
			    padding: 10px;
			}
			.individual-message {
			    background-color: rgba(255, 255, 255, 0.9);
			    padding: 5px;
			    margin: 10px auto;
			    border-radius: 3px;
			    width: 600px;
			}
			.username, .time {
			    font-weight: 700;
			    font-size: 8pt;
			}
			.time {
			    font-weight: 200;
			    float: right;
			}
			#choose-user {
			    position: fixed;
			    top: 0;
			    left: 0;
			    width: 100vw;
			    height: 100vh;
			    background-color: rgba(243,134, 48, 0.8);
			}
			.username-input {
			    top: 50%;
			    width: 500px;
			    height: 50px;
			    text-align: center;
			    margin: 0 auto;
			    right: 0;
			    /* left is already defined */
			    font-size: 20pt;  
			}
		</style>
	</head>
	<body>
		<div id='choose-user'>
		    <input type='text' name='username' class='username-input' placeholder='username'></input>
		</div>
		<input type='text' name='response' class='response' placeholder='write message here'></input>
		<div id='messages'></div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	</body>
</html>
<script>
	$(window).load(function() {
		$("html, body").animate({ scrollTop: $(document).height() }, 1000);
	});
	$(window).keypress(function( event ) {
		if (event.which == 13) {
			$("html, body").animate({ scrollTop: $(document).height() }, 1000);
		}
	});
	$(document).keypress(function( event ) {
	    if (event.which == 13) {
	        $("#choose-user").fadeOut(200);
	    }
	});
	$(document).ready(function () {
		$.get( "database.txt", function( data ) {
			$("#messages").html("");
			data = data.split("<&p>");
			for (x = 0; x < data.length; x++) {
				data[x] = data[x].split("<&v>");
				date = new Date(parseInt(data[x][2], 10));
				hours = date.getHours()
				if (date.getMinutes() >= 10) {
					minutes = date.getMinutes()
				} else {
					minutes = "0" + date.getMinutes()
				}
				if (date.getSeconds() >= 10) {
					seconds = date.getSeconds()
				} else {
					seconds = "0" + date.getSeconds()
				}
				data[x][2] = hours + ":" + minutes + ":" + seconds
			}
			for (x = 0; x < data.length - 1; x++) {
				$("#messages").append("<div class='individual-message'> <span class='username'>" + data[x][0] + "</span><span class='time'>" + data[x][2] + "</span><br><span class='message'>" + data[x][1] + "</span></div>");
			}
		});
	});
	$(document).keypress(function( event ) {
		if (event.which == 13) {
			response = $(".response").val();
			username = $(".username-input").val();
			var dataString = 'response=' + response + '&time=' + new Date().getTime() + '&username=' + username;
			$.ajax({
				type: "POST",
				url: "action.php",
				data: dataString,
				// this all sends the data
				success: function() { // this function says that on success, retrieve comments from database.
					$(".response").val("");
					$.get( "database.txt", function( data ) {
						$("#messages").html("");
						data = data.split("<&p>");
						for (x = 0; x < data.length; x++) {
							data[x] = data[x].split("<&v>");
							date = new Date(parseInt(data[x][2], 10));
							hours = date.getHours()
							if (date.getMinutes() >= 10) {
								minutes = date.getMinutes()
							} else {
								minutes = "0" + date.getMinutes()
							}
							if (date.getSeconds() >= 10) {
								seconds = date.getSeconds()
							} else {
								seconds = "0" + date.getSeconds()
							}
							data[x][2] = hours + ":" + minutes + ":" + seconds
						}
						for (x = 0; x < data.length - 1; x++) {
							$("#messages").append("<div class='individual-message'> <span class='username'>" + data[x][0] + "</span><span class='time'>" + data[x][2] + "</span><br><span class='message'>" + data[x][1] + "</span></div>");
						}
					});
				}
			});
		}
	});
	var questions_update = setInterval(function () {
		$.get( "database.txt", function( data ) {
			$("#messages").html("");
			data = data.split("<&p>");
			for (x = 0; x < data.length; x++) {
				data[x] = data[x].split("<&v>");
				date = new Date(parseInt(data[x][2], 10));
				hours = date.getHours()
				if (date.getMinutes() >= 10) {
					minutes = date.getMinutes()
				} else {
					minutes = "0" + date.getMinutes()
				}
				if (date.getSeconds() >= 10) {
					seconds = date.getSeconds()
				} else {
					seconds = "0" + date.getSeconds()
				}
				data[x][2] = hours + ":" + minutes + ":" + seconds
			}
			for (x = 0; x < data.length - 1; x++) {
				$("#messages").append("<div class='individual-message'> <span class='username'>" + data[x][0] + "</span><span class='time'>" + data[x][2] + "</span><br><span class='message'>" + data[x][1] + "</span></div>");
			}
		});		
	}, 2000);
</script>
<!-- when updating $.get(), make sure to do on post, on load, and on setInterval -->
