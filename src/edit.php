<?php

session_start();
include('functions.php');
if(!isset($_SESSION['id'])){
	header('Location:index.php');
}

if(isset($_FILES['img'])){
	if (!empty($_FILES['img'])) {
		setUserImg($_SESSION['id'],$_FILES['img'],intval($GLOBALS['maxFileSize']));
	}
}

if (isset($_POST['name'])) {
	if(empty($_POST['name'])){
		header('Location:profile.php?user='.$_SESSION['id']."&edit&errorEmptyInput");
	}else{
		setUserName($_SESSION['id'],$_POST['name']);
		header('Location:profile.php?user='.$_SESSION['id']."&edit&success");
	}
}

if (isset($_POST['surname'])) {
	if(empty($_POST['surname'])){
		header('Location:profile.php?user='.$_SESSION['id']."&edit&errorEmptyInput");
	}else{
		setUserSurname($_SESSION['id'],$_POST['surname']);
		header('Location:profile.php?user='.$_SESSION['id']."&edit&success");
	}
}

if (isset($_POST['pseudo'])) {
	if(empty($_POST['pseudo'])){
		header('Location:profile.php?user='.$_SESSION['id']."&edit&errorEmptyInput");
	}else{
		setUserPseudo($_SESSION['id'],$_POST['pseudo']);
		header('Location:profile.php?user='.$_SESSION['id']."&edit&success");
	}
}

if (isset($_POST['mail'])) {
	if(empty($_POST['mail'])){
		header('Location:profile.php?user='.$_SESSION['id']."&edit&errorEmptyInput");
	}else{
		setUserMail($_SESSION['id'],$_POST['mail']);
		header('Location:profile.php?user='.$_SESSION['id']."&edit&success");
	}
}

if (isset($_POST['pass'])) {
	if(empty($_POST['pass'])){
		header('Location:profile.php?user='.$_SESSION['id']."&edit&errorEmptyInput");
	}else{
		$pass=sha1($_POST['pass'].$_SESSION['mail']);
		setUserPass($_SESSION['id'],$pass);
		header('Location:profile.php?user='.$_SESSION['id']."&edit&success");
	}
}
?>