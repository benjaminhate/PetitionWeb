<?php

session_start();
include('functions.php');

if(isset($_SESSION['id'])){
	$checkSignature=getSignature($_SESSION['id'],$_GET['petition']);
	$petition=getPetitionById($_GET['petition']);
	if(empty($checkSignature)){
		$nbSign=$petition['nbSign']+1;
		addSignature($_SESSION['id'],$_GET['petition'],$nbSign);
	}else{
		$nbSign=$petition['nbSign']-1;
		cancelSignature($_SESSION['id'],$_GET['petition']);
	}
	updateNbSignPetition($_GET['petition'],$nbSign);
	header('Location:index.php?petition='.$_GET['petition']);
}else{
	header('Location:index.php?signin&signpetitionfail='.$_GET['petition']);
}

?>