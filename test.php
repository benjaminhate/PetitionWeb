<?php

include('config.php');

session_start();
session_destroy();

$destroy="DROP DATABASE ".$GLOBALS['dbName'];
$connect=mysqli_connect($GLOBALS['dbServ'],$GLOBALS['dbUser'],$GLOBALS['dbPass']);
mysqli_query($connect,$destroy);

include('install.php');

$name="admin";
$surname="admin";
$pseudo="admin";
$mail="admin@gmail.com";
$password="password";
$pass=sha1($password.$mail);
addUser($name,$surname,$pseudo,$mail,$pass);
$name="Princesse";
$surname="Pingouin";
$pseudo="PrincessePingouin";
$mail="princessepingouin@gmail.com";
$password="princessepingouin";
$pass=sha1($password.$mail);
$img='princessepingouin.jpg';
addUser($name,$surname,$pseudo,$mail,$pass,$img);

addCategory("Politique");
addCategory("Environnement");
addCategory("Animaux");
addCategory("Santé");
addCategory("ENSEIRB");

$title="Test";
$description="Je teste mon test.php.";
$categoryId=getCategoryAlea()['0']['id'];
$userId=getUserAlea()['0']['id'];
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => NULL, 'dateEnd' => NULL);
addPetition($infos);

$title="Test2";
$description="Je teste mon test.php.";
$categoryId=getCategoryAlea()['0']['id'];
$expSign=rand(1,10);
$userId=getUserAlea()['0']['id'];
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => $expSign, 'dateEnd' => NULL);
addPetition($infos);

$title="Test3";
$description="Je teste mon test.php.";
$categoryId=getCategoryAlea()['0']['id'];
$expSign=rand(1,10);
$dateEnd=mktime(0,0,0,05,18,2017);
$userId=getUserAlea()['0']['id'];
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => $expSign, 'dateEnd' => $dateEnd);
addPetition($infos);

$title="Test4";
$description="Je teste mon test.php.";
$categoryId=getCategoryAlea()['0']['id'];
$expSign=rand(1,10);
$nbSign=$expSign-1;
$dateEnd=mktime(0,0,0,06,18,2017);
$userId=getUserAlea()['0']['id'];
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => $nbSign, 'expSign' => $expSign, 'dateEnd' => $dateEnd);
addPetition($infos);

header('Location:index.php');

?>