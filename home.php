<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
    <?php
    	session_start();
    	include('functions.php');
    	if(!isset($_SESSION['id'])){
    		if(isset($_GET['startpetition'])){
    			header('Location:index.php?signin&startpetitionfail');
    		}else{
    			header('Location:index.php');
    		}
    	}
    	$id=$_SESSION['id'];
    ?>
    <title><?php $GLOBALS['siteName'] ?></title>
</head>
<body>
	<div class="container">
      <?php
        include('header.php');
      ?>
      <div class="body">
      <?php
      	if(isset($_GET['startpetition'])){
      ?>
        <div class="createPetition">
            <form action="home.php" method="post">
              <input type="text" name="title" placeholder="Title"> <br>
              <textarea name="description" placeholder="Description" cols="50" rows="10"></textarea> <br>
              <input type="text" name="recipient" placeholder="Recipient"> <br>
              <input type="date" name="dateEnd" placeholder="End date"> <br>
              <input type="number" name="expSign" placeholder="Signs expected"> <br>
              <select name="category">
              	<?php
              		$categories=getAllCategories();
              		foreach ($categories as $key => $value) {
              	?>
              	<option value="<?php echo $value['name'] ?>"><?php echo $value['name']; ?></option>
              	<?php
              		}
              	?>
              </select> <br>
              <input type="submit" name="createPetition" value="Create">
            </form>
          </div>
          <?php } ?>
      </div>
      <?php
        include('footer.php');
      ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
</body>
</html>