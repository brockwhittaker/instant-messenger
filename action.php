<?php
/*
Essentially, we want two users to be able to connect to the same database file. Once they do, they stay connected and recieve and send new messages
using ajax calls and some PHP. The files are saved in a text file.

the structure should be as such:

	user -> writes comment -> submits
		submitted comment -> val() taken -> ajax sent to a php file
		php file processed -> stored into text file
			the processed file should include the message, the time, and the user who sent it, delimited for separation
		php file retrieved by ajax get request
		file should be exploded -> split and processed -> process time
		processed file -> output into divs dynamically using jquery
	display on screen

database should be delimited by <&v> and <&p> like before as such:
	user<&v>message<&v>time<&p>
*/

$path = 'database.txt';

$response = $_POST['response'];
$username = $_POST['username'];
$time = $_POST['time'];

$response_mod = $username . "<&v>" . $response . "<&v>" . $time . "<&p>";

if (strlen($_POST['response']) > 0) {
	$contents = file_get_contents($path);
	$contents .= $response_mod;
print_r($contents);
	$handle = fopen($path, 'w');
	fwrite($handle, $contents);
}
?>
