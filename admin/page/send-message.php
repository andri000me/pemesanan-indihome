<?php 
	
	function send_messages($destination,$author,$_encrypt,$subject,$message,$con){	
		$sql="INSERT INTO messages (destination,author,_encrypt,subject,message) values ('$destination','$author','$_encrypt','$subject','$message')";
		$send=mysqli_query($con, $sql);
		// echo $sql;
		return $send;
	}
	$_encrypt			=	$_POST['_encrypt'];
	$author				=	$_POST['author'];
	$destination		=	$_POST['destination'];
	$subject			=	$_POST['subject'];
	$message			=	$_POST['message'];
	send_messages($destination,$author,$_encrypt,$subject,$message,$con);
	// header('location: ../?p=Request');
 ?>