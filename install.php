<?php

include("functions.php");

$createDb="CREATE DATABASE IF NOT EXISTS ".$GLOBALS['dbName'];

$createPetitions="CREATE TABLE IF NOT EXISTS Petitions (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  categoryId INT NOT NULL,
  nbSign INT NOT NULL,
  expSign INT DEFAULT NULL,
  userId INT NOT NULL,
  description VARCHAR(1000),
  dateBegin TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  dateEnd TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (categoryId) REFERENCES Categories(id),
  FOREIGN KEY (userId) REFERENCES Users(id)
)";

$createCategories="CREATE TABLE IF NOT EXISTS Categories (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY (id)
)";

$createUsers="CREATE TABLE IF NOT EXISTS Users (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  surname VARCHAR(255) NOT NULL,
  pseudo VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)";

$createSignatures="CREATE TABLE IF NOT EXISTS Signatures (
  petitionId INT NOT NULL,
  userId INT NOT NULL,
  dateSign TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  numberth INT NOT NULL,
  PRIMARY KEY (petitionId,userId),
  FOREIGN KEY (petitionId) REFERENCES Petitions(id),
  FOREIGN KEY (userId) REFERENCES Users(id)
)";

$first_connect=mysqli_connect($GLOBALS['dbServ'],$GLOBALS['dbUser'],$GLOBALS['dbPass']);

mysqli_query($first_connect,$createDb);
echo mysqli_info($first_connect);
echo mysqli_error($first_connect);

$connect=connection();

mysqli_query($connect,$createCategories);
echo mysqli_info($connect);
echo mysqli_error($connect);

mysqli_query($connect,$createUsers);
echo mysqli_info($connect);
echo mysqli_error($connect);

mysqli_query($connect,$createPetitions);
echo mysqli_info($connect);
echo mysqli_error($connect);

mysqli_query($connect,$createSignatures);
echo mysqli_info($connect);
echo mysqli_error($connect);

mysqli_close($connect);

echo "<p>Installation complete</p>";

?>
