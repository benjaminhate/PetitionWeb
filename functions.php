<?php

include("config.php");

function connection(){
  return mysqli_connect($GLOBALS['dbServ'],$GLOBALS['dbUser'],$GLOBALS['dbPass'],$GLOBALS['dbName']);
}

function addCategory($name){
  $connect=connection();
  $addCat="INSERT INTO Categories VALUES ($name)";
  mysqli_query($connect,$addCat);
  mysqli_close($connect);
}

?>
