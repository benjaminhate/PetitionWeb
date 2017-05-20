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
$img='img/princessepingouin.jpg';
addUser($name,$surname,$pseudo,$mail,$pass,$img);

addCategory("Politique");
addCategory("Nourriture");
addCategory("Animaux");
addCategory("Santé");
addCategory("Environnement");
addCategory("Société");
addCategory("ENSEIRB");

$title="PLUS DE COURS à 8h";
$description="Madame, Monsieur,".'\r\n'."L’heure est grave, cette année nous avons comptabilisé plus de 100h de cours à 8h pour la filière Telecom, outre le fait que nous mettre des cours en plein milieux de ma nuit me semble pas correct, il est difficile de suivre une fois les dits cours loupés  le reste des cours. J’aimerais par cette pétition mettre en évidence la haute cruauté des cours à 8h, ils nous forcent pour la plupart à nous lever à 7h06 soit 6h66 ( vous voyez bien...), quand bien même nous réussirions à sortir des bras de Morphée, il est souvent trop tard pour qu’il nous reste du temps pour manger!".'\r\n'."Voilà c’est plus possible ";
$categoryId=getCategoryByName('ENSEIRB')['id'];
$userId=getUserByMail('princessepingouin@gmail.com')['id'];
$dateEnd=mktime(0,0,0,6,1,2017);
$expSign=500;
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => $expSign, 'dateEnd' => $dateEnd);
addPetition($infos);

$title="POUR L'OUVERTURE D'UN RESTAURANT POLONAIS";
$description="Arrivée en septembre a Bordeaux, j'ai eu le malheur de contaster qu'il n'y avait AUCUN restaurant servant de la cuisine polonaise dans cette merveilleuse ville de Bordeaux.".'\r\n'."On va pas se mentir, on veut des PIEROGHI !";
$categoryId=getCategoryByName('Nourriture')['id'];
$userId=getUserByMail('princessepingouin@gmail.com')['id'];
$dateEnd=mktime(0,0,0,5,20,2017);
$expSign=2;
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => $expSign, 'dateEnd' => $dateEnd);
addPetition($infos);

$title="POUR QUE NOÉMIE COHEN ARRETE DE VENIR EN PYJAMA";
$description="Noemie Cohen, élève de T1, oublie couramment de s'habiller le matin, souvent parce que l'on commence à 8h (cf petition contre les cours à 8h).".'\r\n'."Bien que nous comprenions celle-ci, il n'est plus possible de venir habillée en pyjama à l'ENSEIRB.".'\r\n\r\n'."Pour le bien de tous, Noémie Cohen doit arrêter!";
$categoryId=getCategoryByName('ENSEIRB')['id'];
$userId=getUserByMail('princessepingouin@gmail.com')['id'];
$dateEnd=mktime(0,0,0,5,25,2017);
$expSign=63;
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => $expSign, 'dateEnd' => $dateEnd);
addPetition($infos);

$title="POUR QUE MES COLOCS FASSENT MA VAISSELLE";
$description="Dur dur de vivre à plusieurs, dur dur de partager une salle de bain et une cuisne.".'\r\n'."Mes colocataires ne font aucun effort et ne font pas MA vaisselle pour me remercier de vivre avec eux.".'\r\n'."Ce serait la moindre des choses!";
$categoryId=getCategoryByName('Société')['id'];
$userId=getUserByMail('princessepingouin@gmail.com')['id'];
$dateEnd=mktime(0,0,0,5,30,2017);
$expSign=10;
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => $expSign, 'dateEnd' => $dateEnd);
addPetition($infos);

$title="Pour que PrincessePingouin arrête de râler";
$description="PrincessePingouin fait des pétitions pour n'importe quoi ces temps-ci.".'\r\n'."Il serait temps qu'elle arrête.".'\r\n'."Votez mes amis, votez pour qu'elle arrête de se plaindre de tout dans sa vie !";
$categoryId=getCategoryByName('Politique')['id'];
$userId=getUserByMail('admin@gmail.com')['id'];
$dateEnd=NULL;
$expSign=NULL;
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => $expSign, 'dateEnd' => $dateEnd);
addPetition($infos);

$title="Pour qu'on ait une bonne note à notre projet Web";
$description="Monsieur le professeur,".'\r\n'."Nous avons beaucoup appris avec ce projet, nous avons essayé de respecter au mieux vos consignes et vos suggestions de bonus, nous avons créé une fonction de recherche, utilisé du javascript et même généré des pétitions aléatoires. Nous aimerions beaucoup avoir une bonne note.".'\r\n'."Merci <3";
$categoryId=getCategoryByName('ENSEIRB')['id'];
$userId=getUserByMail('admin@gmail.com')['id'];
$dateEnd=NULL;
$expSign=1;
$infos = array('title' => $title, 'description' => $description, 'categoryId' => $categoryId, 'userId' => $userId, 'nbSign' => 0, 'expSign' => $expSign, 'dateEnd' => $dateEnd);
addPetition($infos);

header('Location:index.php');

?>