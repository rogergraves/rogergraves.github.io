<?php 

	require_once('config.php');

	// Sender Info
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$message = trim($_POST['message']);
	$Sender_email = 'roger@technobros.com';

	// Check Info
	$pattern = "^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$^";
	if(!preg_match_all($pattern, $email, $out)) {
		$err = MSG_INVALID_EMAIL; // Invalid email
	}
	if(!$email) {
		$err = MSG_INVALID_EMAIL; // No Email
	}	
	if(!$message) {
		$err = MSG_INVALID_MESSAGE; // No Message
	}
	if (!$name) {
		$err = MSG_INVALID_NAME; // No name 
	}

	//create a boundary string. It must be unique 
	//so we use the MD5 algorithm to generate a random hash
	$random_hash = md5(date('r', time())); 
	
	//define the headers we want passed. Note that they are separated with \r\n
	$headers = "From: ".$Sender_email."\r\n";
	
	//add boundary string and mime type specification
	$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\""; 
	
	// Include HTML template
	$body = include(TEMPLATE);

	if (!$err){
		
		//send the email
		$sent = mail(TO_EMAIL,SUBJECT, $body, $headers ); 
		
		if ($sent) {
				// If the message is sent successfully print
				echo "SEND"; 
			} else {
				// Display Error Message
				echo MSG_SEND_ERROR; 
			}
	} else {
		echo $err; // Display Error Message
	}
?>