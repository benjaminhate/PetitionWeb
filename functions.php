<?php

include("config.php");

function connection(){
  return mysqli_connect($GLOBALS['dbServ'],$GLOBALS['dbUser'],$GLOBALS['dbPass'],$GLOBALS['dbName']);
}

function addCategory($infos){
  $connect=connection();
  $addCat="INSERT INTO Categories (name) VALUES ('$infos[name]')";
  mysqli_query($connect,$addCat);
  mysqli_close($connect);
}

function getAllCategories(){
	$connect=connection();
	$getAllCategories="SELECT * FROM Categories";
	$res=mysqli_query($connect,$getAllCategories);
	$categories=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $categories;
}

function getCategory($id){
	$connect=connection();
	$getCategory="SELECT * FROM Categories WHERE id=$id";
	$res=mysqli_query($connect,$getCategory);
	$category=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $category;
}

function addUser($infos){
	$connect=connection();
	$addUser="INSERT INTO Users (name,surname,pseudo,mail) VALUES ('$infos[name]','$infos[surname]','$infos[pseudo]','$infos[mail]')";
	mysqli_query($connect,$addUser);
	mysqli_close($connect);
}

function getAllUsers(){
	$connect=connection();
	$getAllUser="SELECT * FROM Users";
	$res=mysqli_query($connect,$getAllUser);
	$users=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $users;
}

function getUser($id){
	$connect=connection();
	$getUser="SELECT * FROM Categories WHERE id=$id";
	$res=mysqli_query($connect,$getUser);
	$user=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $user;
}

function addPetition($infos){
	$connect=connection();
	$addPetition="INSERT INTO Petitions (title,categoryId,expSign,author,userId,description,dateEnd,recipient) VALUES 
		('$infos[title]','$infos[categoryId]','$infos[expSign]','$infos[author]','$infos[userId]','$infos[description]','$infos[dateEnd]','$infos[recipient]')";
	mysqli_query($connect,$addPetition);
	mysqli_close($connect);
}

function addSignature($infos){
	$connect=connection();
	$addSignature="INSERT INTO Signatures (petitionId,userId) VALUES ('$infos[petitionId]','$infos[userId]')";
	mysqli_query($connect,$addSignature);
	echo "<p>".mysqli_error($connect)."</p>";
	mysqli_close($connect);
}

?>
