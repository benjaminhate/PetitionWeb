<?php

include('config.php');

$destroy="DROP DATABASE ".$GLOBALS[dbName];
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

addCategory("Politique");
addCategory("Environnement");
addCategory("Animaux");
addCategory("Santé");
addCategory("ENSEIRB");

$title="Test";
$description="Je teste mon test.php.";
$categoryId=getCategoryAlea()[0]['id'];
$userId=getUserAlea()[0]['id'];
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => 'NULL', 'dateEnd' => 'NULL');
addPetition($infos);

header('Location:index.php');

?>