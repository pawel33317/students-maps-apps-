<?php
session_start();
if(!isset($_GET['set'])){
	echo 'Problem brak $_GET set';
	die();
}

if($_GET['set'] == 0){
	$_SESSION['myPosition'] = false;
	echo 'Brak ustawionej pozycji';
}

if($_GET['set'] == 1){
	$_SESSION['myPosition'] = true;
	$_SESSION['myLatitude'] = $_GET['myLatitude'];
	$_SESSION['myLongitude'] = $_GET['myLongitude'];

	echo 'Pozycja zapisana';
}

?>