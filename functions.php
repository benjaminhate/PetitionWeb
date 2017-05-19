<?php

include("config.php");

function connection(){
  return mysqli_connect($GLOBALS['dbServ'],$GLOBALS['dbUser'],$GLOBALS['dbPass'],$GLOBALS['dbName']);
}

function addCategory($name){
  $connect=connection();
  $addCat="INSERT INTO Categories (name) VALUES (?)";
  $stmt=mysqli_prepare($connect,$addCat);
  mysqli_stmt_bind_param($stmt,'s',$name);
  mysqli_stmt_execute($stmt);
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

function getCategoryById($id){
	$connect=connection();
	$getCategory="SELECT * FROM Categories WHERE id=?";
	$stmt=mysqli_prepare($connect,$getCategory);
	mysqli_stmt_bind_param($stmt,'i',$id);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$category=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $category;
}

function getCategoryAlea(){
  	$connect=connection();
  	$getCatAlea="SELECT * FROM Categories ORDER BY RAND() LIMIT 0,1";
  	$res=mysqli_query($connect,$getCatAlea);
  	$category=mysqli_fetch_all($res,MYSQLI_ASSOC);
  	mysqli_free_result($res);
  	mysqli_close($connect);
  	return $category;
}

function addUser($name,$surname,$pseudo,$email,$password,$img='generic.jpg'){
	$connect=connection();
	$addUser="INSERT INTO Users (name,surname,pseudo,mail,password,img) VALUES (?,?,?,?,?,?)";
	$stmt=mysqli_prepare($connect,$addUser);
	mysqli_stmt_bind_param($stmt,'ssssss',$name,$surname,$pseudo,$email,$password,$img);
	mysqli_stmt_execute($stmt);
	mysqli_close($connect);
}

function updateUser($infos){
	setUserName($infos['name']);
	setUserSurname($infos['surname']);
	setUserPseudo($infos['pseudo']);
	setUserMail($infos['mail']);
	setUserImg($infos['img']);
	if(!empty($infos['password'])){
		setUserPass($infos['password']);
	}
}

function setUserName($id,$name){
	$connect=connection();
	$setName="UPDATE Users SET name=? WHERE id=?";
	$stmt=mysqli_prepare($connect,$setName);
	mysqli_stmt_bind_param($stmt,'si',$name,$id);
	mysqli_stmt_execute($stmt);
	$_SESSION['name']=$name;
	mysqli_close($connect);
}

function setUserSurname($id,$surname){
	$connect=connection();
	$setSurname="UPDATE Users SET surname=? WHERE id=?";
	$stmt=mysqli_prepare($connect,$setSurname);
	mysqli_stmt_bind_param($stmt,'si',$surname,$id);
	mysqli_stmt_execute($stmt);
	$_SESSION['surname']=$surname;
	mysqli_close($connect);
}

function setUserPseudo($id,$pseudo){
	$connect=connection();
	$setPseudo="UPDATE Users SET pseudo=? WHERE id=?";
	$stmt=mysqli_prepare($connect,$setPseudo);
	mysqli_stmt_bind_param($stmt,'si',$pseudo,$id);
	mysqli_stmt_execute($stmt);
	$_SESSION['pseudo']=$pseudo;
	mysqli_close($connect);
}

function setUserMail($id,$mail){
	$connect=connection();
	$setMail="UPDATE Users SET mail=? WHERE id=?";
	$stmt=mysqli_prepare($connect,$setMail);
	mysqli_stmt_bind_param($stmt,'si',$mail,$id);
	mysqli_stmt_execute($stmt);
	$_SESSION['mail']=$mail;
	mysqli_close($connect);
}

function setUserPass($id,$pass){
	$connect=connection();
	$setPass="UPDATE Users SET pass=? WHERE id=?";
	$stmt=mysqli_prepare($connect,$setPass);
	mysqli_stmt_bind_param($stmt,'si',$pass,$id);
	mysqli_stmt_execute($stmt);
	mysqli_close($connect);
}

function setUserImg($id,$file,$maxsize){
	$connect=connection();
	$extensions=array('.png','.jpg','.gif','.jpeg');
	$extension=strtolower(strrchr($file['name'],'.'));
	if(!in_array($extension, $extensions)){
		header("Location:profile.php?user=".$id."&edit&errorImgExt");
	}else{
		if($file['size'] > $maxsize){
			header("Location:profile.php?user=".$id."&edit&errorImgSize");
		}else{
			$fichier=basename($file['name']);
			if(move_uploaded_file($file['tmp_name'], $fichier)){
				$setImg="UPDATE Users SET img=? WHERE id=?";
				$stmt=mysqli_prepare($connect,$setImg);
				mysqli_stmt_bind_param($stmt,'si',$img,$id);
				mysqli_stmt_execute($stmt);
				$_SESSION['img']=$file['name'];
				header("Location:profile.php?user=".$_SESSION['id']."&edit&success");
			}else{
				header("Location:profile.php?user=".$id."&edit&errorImgLoad");
			}
		}
	}
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

function getUserById($id){
	$connect=connection();
	$getUser="SELECT * FROM Users WHERE id=?";
	$stmt=mysqli_prepare($connect,$getUser);
	mysqli_stmt_bind_param($stmt,'i',$id);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$user=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $user;
}

function getUserByMail($mail){
	$connect=connection();
	$getUserByMail="SELECT * FROM Users WHERE mail=?";
	$stmt=mysqli_prepare($connect,$getUserByMail);
	mysqli_stmt_bind_param($stmt,'s',$mail);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$userByMail=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $userByMail;
}

function getUserByPseudo($pseudo){
	$connect=connection();
	$getUserByPseudo="SELECT * FROM Users WHERE pseudo=?";
	$stmt=mysqli_prepare($connect,$getUserByPseudo);
	mysqli_stmt_bind_param($stmt,'s',$pseudo);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$userByPseudo=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $userByPseudo;
}

function getUserAlea(){
  	$connect=connection();
  	$getUsrAlea="SELECT * FROM Users ORDER BY RAND() LIMIT 0,1";
  	$res=mysqli_query($connect,$getUsrAlea);
  	$user=mysqli_fetch_all($res,MYSQLI_ASSOC);
  	mysqli_free_result($res);
  	mysqli_close($connect);
  	return $user;
}

function addPetition($infos){
	$connect=connection();
	$addPetition="INSERT INTO Petitions (title,categoryId,nbSign,expSign,userId,description,dateEnd) VALUES (?,?,?,?,?,?,FROM_UNIXTIME(?))";
	$stmt=mysqli_prepare($connect,$addPetition);
	mysqli_stmt_bind_param($stmt,'siiiiss',$infos['title'],$infos['categoryId'],$infos['nbSign'],$infos['expSign'],$infos['userId'],$infos['description'],$infos['dateEnd']);
	mysqli_stmt_execute($stmt);
	mysqli_close($connect);
}

function getAllPetitions(){
	$connect=connection();
	$getAllPetition="SELECT * FROM Petitions ORDER BY dateBegin DESC";
	$res=mysqli_query($connect,$getAllPetition);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function getAllPetitionsByCategory($categoryId){
	$connect=connection();
	$getAllPetitionByCat="SELECT * FROM Petitions WHERE categoryId=? ORDER BY dateBegin DESC";
	$stmt=mysqli_prepare($connect,$getAllPetitionByCat);
	mysqli_stmt_bind_param($stmt,'i',$categoryId);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function getAllPetitionssuccess(){
  $connect=connection();
  $getAllPetitionSuccess="SELECT * FROM Petitions WHERE nbSign >= expSign ORDER BY dateBegin DESC";
  $res=mysqli_query($connect,$getAllPetitionSuccess);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function getAllPetitionsfinish(){
	$connect=connection();
	date_default_timezone_set('Europe/Paris');
	$time=date('Y-m-d H:i:s');
	$getAllPetitionfinish="SELECT * FROM Petitions WHERE dateEnd < '".$time."' ORDER BY dateBegin DESC";
	$res=mysqli_query($connect,$getAllPetitionfinish);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function getAllPetitionsRecent(){
	$connect=connection();
	$getAllPetitionrecent="SELECT * FROM Petitions WHERE DATE(dateBegin) BETWEEN DATE(ADDDATE(NOW(),-7)) AND DATE(NOW()) ORDER BY dateBegin DESC";
	$res=mysqli_query($connect,$getAllPetitionrecent);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function getAllPetitionsUrg(){
	$connect=connection();
	$getAllPetitionurg="SELECT * FROM Petitions WHERE DATE(dateEnd) BETWEEN DATE(NOW()) AND DATE(ADDDATE(NOW(),+7)) ORDER BY dateBegin DESC";
	$res=mysqli_query($connect,$getAllPetitionurg);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function getPetitionAlea(){
  	$connect=connection();
  	$getPetAlea="SELECT * FROM Petitions ORDER BY RAND() LIMIT 0,1";
  	$res=mysqli_query($connect,$getPetAlea);
  	$petition=mysqli_fetch_all($res,MYSQLI_ASSOC);
  	mysqli_free_result($res);
  	mysqli_close($connect);
  	return $petition;
}

function getAllPetitionsByUser($userId){
	$connect=connection();
	$getAllPetitionByUser="SELECT * FROM Petitions WHERE userId=? ORDER BY dateBegin DESC";
	$stmt=mysqli_prepare($connect,$getAllPetitionByUser);
	mysqli_stmt_bind_param($stmt,'i',$userId);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function getPetitionById($id){
	$connect=connection();
	$getPetition="SELECT * FROM Petitions WHERE id=?";
	$stmt=mysqli_prepare($connect,$getPetition);
	mysqli_stmt_bind_param($stmt,'i',$id);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$petition=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petition;
}

function getPetitionSignedByUser($userId){
	$connect=connection();
	$getPetitionSigned="SELECT * FROM Signatures JOIN Petitions ON Petitions.id=Signatures.petitionId WHERE Signatures.userId=?";
	$stmt=mysqli_prepare($connect,$getPetitionSigned);
	mysqli_stmt_bind_param($stmt,'i',$userId);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$petitions=mysqli_fetch_all($res,MYSQLI_ASSOC);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $petitions;
}

function updateNbSignPetition($id,$nbSign){
	$connect=connection();
	$addNbSign="UPDATE Petitions SET nbSign=? WHERE id=?";
	$stmt=mysqli_prepare($connect,$addNbSign);
	mysqli_stmt_bind_param($stmt,'ii',$nbSign,$id);
	mysqli_stmt_execute($stmt);
	mysqli_close($connect);
}

function addSignature($userId,$petitionId,$numberth){
	$connect=connection();
	$addSignature="INSERT INTO Signatures (petitionId,userId,numberth) VALUES (?,?,?)";
	$stmt=mysqli_prepare($connect,$addSignature);
	mysqli_stmt_bind_param($stmt,'iii',$petitionId,$userId,$numberth);
	mysqli_stmt_execute($stmt);
	mysqli_close($connect);
}

function cancelSignature($userId,$petitionId){
	$connect=connection();
	$cancelSign="DELETE FROM Signatures WHERE userId=? AND petitionId=?";
	$stmt=mysqli_prepare($connect,$cancelSign);
	mysqli_stmt_bind_param($stmt,'ii',$userId,$petitionId);
	mysqli_stmt_execute($stmt);
	mysqli_close($connect);
}

function getSignature($userId,$petitionId){
	$connect=connection();
	$getSign="SELECT * FROM Signatures WHERE userId=? AND petitionId=?";
	$stmt=mysqli_prepare($connect,$getSign);
	mysqli_stmt_bind_param($stmt,'ii',$userId,$petitionId);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$signature=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $signature;
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
	$userExist=getUserByMail($email);
	if(is_null($userExist)){
		if(isset($_POST['startpetitionfail'])){
			header("Location:index.php?signin&msg=errorConnection&startpetitionfail");
		}else{
			header("Location:index.php?signin&msg=errorConnection");
		}
	}
	if($userExist['password']==sha1($password.$email)){
		$_SESSION['id']=$userExist['id'];
		$_SESSION['name']=$userExist['name'];
		$_SESSION['surname']=$userExist['surname'];
		$_SESSION['pseudo']=$userExist['pseudo'];
		$_SESSION['mail']=$userExist['mail'];
		$_SESSION['img']=$userExist['img'];
		if(isset($_POST['startpetitionfail'])){
			header('Location:home.php?startpetition');
		}elseif(isset($_POST['signpetitionfail'])) {
			header("Location:index.php?petition=$_POST[signpetitionfail]");
		}else{
			header('Location:profile.php?user='.$userExist[id]);
		}
	}else{
		if(isset($_POST['startpetitionfail'])){
			header("Location:index.php?signin&msg=errorConnection&startpetitionfail");
		}elseif (isset($_POST['signpetitionfail'])) {
			header("Location:index.php?signin&msg=errorConnection&signpetitionfail=$_POST[signpetitionfail]");
		}else{
			header("Location:index.php?signin&msg=errorConnection");
		}
	}
	mysqli_close($connect);
}

function sign_up($name,$surname,$pseudo,$email,$password,$password2){
	$userExist=getUserByMail($email);
	$pseudoExist=getUserByPseudo($pseudo);
	$regEx="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
	$checkMail=preg_match($regEx, $email);
	$checkPseudo=strlen($pseudo)>1;
	$checkName=strlen($name)>1;
	$checkSurname=strlen($surname)>1;
	$checkPass=strlen($password)>5;
	$checkPass2=$password==$password2;
	if(!$checkPass2){
		header('Location:index.php?signup&errorPassNotVerified');
	}else{
		if(!$checkPass){
			header('Location:index.php?signup&errorPassIncorrect');
		}else{
			if(!$checkMail){
				header('Location:index.php?signup&errorMailIncorrect');
			}else{
				if(!$checkPseudo){
					header('Location:index.php?signup&errorPseudoIncorrect');
				}else{
					if(!$checkName){
						header('Location:index.php?signup&errorNameIncorrect');
					}else{
						if(!$checkSurname){
							header('Location:index.php?signup&errorSurnameIncorrect');
						}else{
							if($userExist!=NULL){
								header('Location: index.php?signup&errorUserExist');
							}else{
								if($pseudoExist!=NULL){
									header('Location: index.php?signup&errorPseudoUsed');
								}else{
									addUser($name,$surname,$pseudo,$email,sha1($password.$email));
									header('Location:index.php?signin');
								}
							}
						}
					}
				}
			}
		}
	}
}

function getNbPetitionsSigned($userId){
	$connect=connection();
	$getSigned="SELECT count(*) FROM Signatures WHERE userId=?";
	$stmt=mysqli_prepare($connect,$getSigned);
	mysqli_stmt_bind_param($stmt,'i',$userId);
	mysqli_stmt_execute($stmt);
	$res=mysqli_stmt_get_result($stmt);
	$nbSigned=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	mysqli_close($connect);
	return $nbSigned;
}

function searchInPetitions($search){
	$petitions=getAllPetitions();
	$searchPetition = array();
	foreach ($petitions as $key => $petition) {
		$user=getUserById($petition['userId']);
		if(strpos(strtolower($petition['description']),strtolower($search))!==false || strpos(strtolower($petition['title']),strtolower($search))!==false || strpos(strtolower($user['pseudo']),strtolower($search))!==false){
			array_push($searchPetition, $petition);
		}
	}
	return $searchPetition;
}

?>
