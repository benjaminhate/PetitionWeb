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
    		header('Location:index.php');
    	}
    	$name=$_SESSION['name'];
    	$surname=$_SESSION['surname'];
    	$pseudo=$_SESSION['pseudo'];
    	$email=$_SESSION['mail'];
    	$nbSigned=getNbPetitionsSigned($_SESSION['id'])['count(*)'];
    ?>
    <title><?php echo $GLOBALS['siteName']; ?></title>
</head>
<body>
	<div class="container">
      <?php
        include('header.php');
      ?>
      <div class="body">
      <?php
      	if(isset($_GET['edit'])){
      ?>
			<div class=profile>
      	<form action="edit.php" method="post">
					<div class="form-group">
						<label for="name">Name :</label>
						<input type="text" name="name" value="<?php echo $name ?>" placeholder="name"> <br>
					</div>
					<div class="form-group">
						<label for="surname">Surname :</label>
						<input type="text" name="surname" value="<?php echo $surname ?>" placeholder="surname"> <br>
					</div>
					<div class="form-group">
						<label for="pseudo">Pseudo :</label>
						<input type="text" name="pseudo" value="<?php echo $pseudo ?>" placeholder="pseudo"> <br>
					</div>
					<div class="form-group">
						<label for="Email">Email :</label>
						<input type="text" name="email" value="<?php echo $email ?>" placeholder="email"> <br>
					</div>
					<div class="form-group">
						<label for="password">Password :</label>
						<input type="password" name="password" placeholder="change password"> <br>
					</div>
					<div class="form-group">
						<input type="submit" value="Edit">
					</div>
      	</form>
			</div>
      <?php }else{ ?>
        <h1>Profil de : <?php echo $pseudo ?></h1>
        <p>Name : <?php echo $name ?></p>
        <p>Surname : <?php echo $surname ?></p>
        <p>Pseudo : <?php echo $pseudo ?></p>
        <p>Mail : <?php echo $email ?></p>
		<p>Pétitions signées : <?php echo $nbSigned ?></p>
		<p><a href="?edit" class="btn btn-success">Edit profile</a></p>
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
