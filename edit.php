<?php

session_start();
include('functions.php');
if(!isset($_SESSION['id'])){
	header('Location:index.php');
}

$userId=$_SESSION['id'];
$userName=$_POST['name'];
$userSurname=$_POST['surname'];
$userPseudo=$_POST['pseudo'];
$userMail=$_POST['email'];
$userPass=sha1($_POST['password']+$_POST['email']);

$infos = array('id' => $userId, 'name' => $userName, 'surname' => $userSurname, 'pseudo' => $userPseudo, 'mail' => $userMail);
echo empty($_POST['password']);
if(!empty($_POST['password'])){
	$infos['password']=$userPass;
}
updateUser($infos);

?>