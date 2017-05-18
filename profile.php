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
      if(!isset($_GET['user'])){
        header('Location:index.php');
      }
      if(isset($_GET['edit']) && (!isset($_SESSION['id']) || $_GET['user']!=$_SESSION['id'])){
        header('Location:profile.php?user='.$_GET['user']);
      }
      if(!isset($_SESSION['id']) || $_GET['user']!=$_SESSION['id']){
        $user=getUserById($_GET['user']);
        $id=$user['id'];
        $pseudo=$user['pseudo'];
        $img=$user['img'];
      }else{
        $id=$_SESSION['id'];
        $name=$_SESSION['name'];
        $surname=$_SESSION['surname'];
        $pseudo=$_SESSION['pseudo'];
        $email=$_SESSION['mail'];
        $img=$_SESSION['img'];
      }
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
        if(isset($_GET['user'])){
      ?>
      <div class="user_presentation">
          <?php
          if(isset($_GET['edit'])){
          ?>
          <form action="edit.php" method="post" enctype="multipart/form-data">
            <input type="file" id="file" name="img" class="hidden" onchange="this.form.submit();">
            <a onclick="document.getElementById('file').click();" class="imageEdit" style="cursor: pointer;">
            <div class="imgDiv">
              <img id="img" class="img" src="<?php echo $img; ?>" alt="Generic placeholder image" width="140" height="140">
              <span class="modifImg">Modifier</span>
            </div>
            </a>
          </form>
          <?php
          }else{
          ?>
          <div class="imgDiv imageEdit">
            <img class="img" src="<?php echo $img; ?>" alt="Generic placeholder image" width="140" height="140">
          </div>
          
          <?php } ?>
          <h2><?php echo $pseudo; ?></h2>
      <?php
      if(isset($_SESSION['id']) && $_GET['user']==$_SESSION['id'] && !isset($_GET['edit'])){
      ?>
      <div class="edit">
        <a href="profile.php?user=<?php echo $id; ?>&edit">
          <button type="button" class="btn btn-info">Modifier le profil</button>
        </a>
      </div>
      <?php } ?>
      </div>
      <div class="users_petitions">
        <div class="petitions_signees">
          <div class="presentation_petition">
            <h3> Pétitions signées : </h3>
          </div>
      <?php
          $petitionsigned=getPetitionSignedByUser($id);
          if(empty($petitionsigned)){
      ?>
        <div class="Article_small">
          <div class="noSigned">
            Aucune pétition signée.
          </div>
        </div>
      <?php
          }else{
          foreach ($petitionsigned as $key => $petition) {
            $user=getUserById($petition['userId']);
      ?>
        <div class="Article_small">
          <div class="etage">
            <div class="titre">
                <a href="index.php?petition=<?php echo $petition['id']; ?>"><h4><?php echo $petition['title'] ?></h4></a>
            </div>
            <div class="author">
              <p class="blog-post-meta"><?php echo date("d/m/Y",strtotime($petition['dateBegin']));?> by <a href="profile.php?user=<?php echo $user['id']; ?>"><?php echo $user['pseudo']; ?></a></p>
            </div>
          </div>
        <div class="etage">
          <div class="sign">
            <a href="index.php?petition=<?php echo $petition['id']; ?>">
              <button type="button" class="btn btn-warning">Voir plus</button>
            </a>
          </div>
        </div>
        </div>
      <?php
          }
        }
      ?>
      </div>
      <div class="petitions_ecrites">
        <div class="presentation_petition">
          <h3> Pétitions écrites :</h3>
        </div>
      <?php
          $petitionwriten=getAllPetitionsByUser($id);
          if(empty($petitionwriten)){
      ?>
        <div class="Article_small">
          <div class="noSigned">
            Aucune pétition écrite.
          </div>
        </div>
      <?php
        }else{
        foreach ($petitionwriten as $key => $petition) {
      ?>
        <div class="Article_small">
          <div class="etage">
            <div class="titre">
                <a href="index.php?petition=<?php echo $petition['id']; ?>"><h4><?php echo $petition['title'] ?></h4></a>
            </div>
            <div class="author">
              <p class="blog-post-meta"><?php echo date("d/m/Y",strtotime($petition['dateBegin']));?></p>
            </div>
          </div>
          <div class="etage">
            <div class="sign">
              <a href="index.php?petition=<?php echo $petition['id']; ?>">
                <button type="button" class="btn btn-warning">Voir plus</button>
              </a>
            </div>
          </div>
        </div>
      <?php
          }
        }
      ?>
        </div>
      </div>
      <?php
        }
        if(isset($_GET['edit'])){
      ?>
			<!-- <div class=profile>
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
			</div> -->
      <?php } ?>
      <?php
        include('footer.php');
      ?>
    </div>

    <script type="text/javascript">
      function editImg(){
        var file=document.getElementById('file');
        file.click();
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
</body>
</html>
