<?php 

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db   = "indihome";

	$con = mysqli_connect($host, $user, $pass, $db);
	session_start();
	error_reporting(0);

function bulan($bln){
  if($bln == 1){
      $bulan1="Januari";
    }elseif($bln == 2){
      $bulan1="Februari";
    }elseif($bln == 3){
      $bulan1="Maret";
    }elseif($bln == 4){
      $bulan1="April";
    }elseif($bln == 5){
      $bulan1="Mei";
    }elseif($bln == 6){
      $bulan1="Juni";
    }elseif($bln == 7){
      $bulan1="Juli";
    }elseif($bln == 8){
      $bulan1="Agustus";
    }elseif($bln == 9){
      $bulan1="September";
    }elseif($bln == 10){
      $bulan1="Oktober";
    }elseif($bln == 11){
      $bulan1="November";
    }elseif($bln == 12){
      $bulan1="Desember";
  }
  return $bulan1;
}
?>