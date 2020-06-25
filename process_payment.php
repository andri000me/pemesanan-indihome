<?php 
	include 'config/connection.php';
	mysqli_query($con,"INSERT INTO payment (id_subscribe,setor,gateway) values ('".$_POST['id']."','".$_POST['setor']."','".$_POST['gateway']."')");
	mysqli_query($con,"UPDATE subscribe set aktif='waiting' where id_subscribe='".$_POST['id']."'");
	$page='invoice.php?id='.$_POST['id'];
	header('location: '.$page);
 ?>