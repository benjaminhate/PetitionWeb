<?php

include('functions.php');

$petitionAlea=getPetitionAlea();
header("Location:index.php?petition=".$petitionAlea[0]['id']);

?>