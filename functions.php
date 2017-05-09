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

function updateUser($infos){
	$connect=connection();
	if(empty($infos['password'])){
		$update="UPDATE Users SET name='$infos[name]',surname='$infos[surname]',pseudo='$infos[pseudo]',mail='$infos[mail]' WHERE id='$infos[id]'";
	}else{
		$update="UPDATE Users SET name='$infos[name]',surname='$infos[surname]',pseudo='$infos[pseudo]',mail='$infos[mail]',password='$infos[password]' WHERE id='$infos[id]'";
	}
	$_SESSION['name']=$infos['name'];
	$_SESSION['surname']=$infos['surname'];
	$_SESSION['pseudo']=$infos['pseudo'];
	$_SESSION['mail']=$infos['mail'];
	mysqli_query($connect,$update);
	mysqli_error($connect);
	mysqli_close($connect);
	header('Location:profile.php');
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

function getAllPetitions(){
	$connect=connection();
	$getAllPetition="SELECT * FROM Petitions";
	$res=mysqli_query($connect,$getAllPetition);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function getAllPetitionsByCategory($categoryId){
	$connect=connection();
	$getAllPetitionByCat="SELECT * FROM Petitions WHERE categoryId=$categoryId";
	$res=mysqli_query($connect,$getAllPetitionByCat);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function getPetition($id){
	$connect=connection();
	$getPetition="SELECT * FROM Petitions WHERE id=$id";
	$res=mysqli_query($connect,$getPetition);
	$petition=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petition;
}

function addSignature($infos){
	$connect=connection();
	$addSignature="INSERT INTO Signatures (petitionId,userId) VALUES ('$infos[petitionId]','$infos[userId]')";
	mysqli_query($connect,$addSignature);
	echo "<p>".mysqli_error($connect)."</p>";
	mysqli_close($connect);
}

function getNbSubscribers(){
	$connect=connection();
	$getNbSubs="SELECT count(*) FROM Users";
	$res=mysqli_query($connect,$getNbSubs);
	$countSubs=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $countSubs;
}

function sign_in($email,$password){
	$connect=connection();
	$check="SELECT * FROM Users WHERE mail='".$email."'";
	$res=mysqli_query($connect,$check);
	$userExist=mysqli_fetch_assoc($res);
	if(is_null($userExist)){
		header('Location:index.php?msg=errorConnectionUserNotExist');
	}else{
		if($userExist['password']==sha1($password)){
			$_SESSION['id']=$userExist['id'];
			$_SESSION['name']=$userExist['name'];
			$_SESSION['surname']=$userExist['surname'];
			$_SESSION['pseudo']=$userExist['pseudo'];
			$_SESSION['mail']=$userExist['mail'];
			if(isset($_POST['startpetitionfail'])){
				header('Location:home.php?startpetition');
			}else{
				header('Location:profile.php');
			}
		}else{
			header('Location:index.php?msg=errorConnectionWrongPassword');
		}
	} 
	mysqli_close($connect);
}

function sign_up($name,$surname,$pseudo,$email,$password){
	$connect=connection();
	$check="SELECT * FROM Users WHERE mail='".$email."'";
	$res=mysqli_query($connect,$check);
	$userExist=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	if($userExist!=NULL){
		header('Location: index.php?errorUserExist');
	}else{
		$insert="INSERT INTO Users (name,surname,pseudo,mail,password) VALUES ('".$name."','".$surname."','".$pseudo."','".$email."','".sha1($password)."')";
		mysqli_query($connect,$insert);
		header('Location:index.php?signin');
	}
	mysqli_close($connect);
}

function getNbPetitionsSigned($userId){
	$connect=connection();
	$getSigned="SELECT count(*) FROM Signatures WHERE userId='".$userId."'";
	$res=mysqli_query($connect,$getSigned);
	$nbSigned=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $nbSigned;
}

?>
