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
          if(isset($_GET['success'])){
          ?>
          <div class="alert alert-success">L'information a bien été modifiée.</div>
          <?php
          }
          ?>
          <?php
          if(isset($_GET['errorEmptyInput'])){
          ?>
          <div class="alert alert-danger">Le'information envoyée est vide.</div>
          <?php
          }
          ?>
          <?php
          if(isset($_GET['errorImgExt'])){
          ?>
          <div class="alert alert-danger">Le fichier transmis n'est pas une image valide.</div>
          <?php
          }
          ?>
          <?php
          if(isset($_GET['errorImgSize'])){
          ?>
          <div class="alert alert-danger">L'image est trop grosse.</div>
          <?php
          }
          ?>
          <?php
          if(isset($_GET['errorImgLoad'])){
          ?>
          <div class="alert alert-danger">L'image n'a pas réussi à se charger.</div>
          <?php
          }
          ?>
          <?php
          if(isset($_GET['edit'])){
          ?>
          <form action="edit.php" method="post" enctype="multipart/form-data">
            <input type="file" id="file" name="img" class="hidden" onchange="this.form.submit();">
            <a onclick="document.getElementById('file').click();" class="imageEdit" style="cursor: pointer;">
              <div class="imgDiv">
                <img class="img" src="<?php echo $img; ?>" alt="Generic placeholder image" width="140" height="140">
                <span class="modifImg">Modifier</span>
              </div>
            </a>
          </form>
          <div class="edition">
            <div class="edit">
            <form action="edit.php" method="post">
              <div id="input">
                <label for="inputName" class="sr-only">Name</label>
                <input type="name" name="name" id="inputName" class="form-control" placeholder="Nom" value="<?php echo $name; ?>" autofocus>
              </div>
              <p class="editInput"><button class="btn btn-success">Changer nom</button></p>
            </form>
            </div>
            <div class="edit">
              <form action="edit.php" method="post">
                <div id="input">
                  <label for="inputSurname" class="sr-only">Surname</label>
                  <input type="surname" name="surname" id="inputSurname" class="form-control" placeholder="Prénom" value="<?php echo $surname; ?>">
                </div>
                <p class="editInput"><button class="btn btn-success">Changer prénom</button></p>
              </form>
            </div>
            <div class="edit">
              <form action="edit.php" method="post">
                <div id="input">
                  <label for="inputPseudo" class="sr-only">Pseudo</label>
                  <input type="pseudo" name="pseudo" id="inputPseudo" class="form-control" placeholder="Pseudo" value="<?php echo $pseudo; ?>">
                </div>
                <p class="editInput"><button class="btn btn-success">Changer pseudo</button></p>
              </form>
            </div>
            <div class="edit">
              <form action="edit.php" method="post">
                <div id="input">
                  <label for="inputEmail" class="sr-only">Email address</label>
                  <input type="email" name="mail" id="inputEmail" class="form-control" placeholder="Adresse Email" value="<?php echo $email; ?>">
                </div>
                <p class="editInput"><button class="btn btn-success">Changer email</button></p>
              </form>
            </div>
            <div class="edit">
              <form action="edit.php" method="post">
                <div id="input">
                  <label for="inputPassword" class="sr-only">Password</label>
                  <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Mot de Passe">
                </div>
                <p class="editInput"><button class="btn btn-success" type="submit">Changer mot de passe</button></p>
              </form>
            </div>
      </div>
          <?php
          }else{
          ?>
          <div class="imgDiv imageEdit">
            <img class="img" src="<?php echo $img; ?>" alt="Generic placeholder image" width="140" height="140">
          </div>
          <?php if($_GET['user']==$_SESSION['id']){ ?>
          <div class="infos">
            <h4><b>Nom</b> : <?php echo $name; ?></h4>
            <h4><b>Prénom</b> : <?php echo $surname; ?></h4>
            <h4><b>Mail</b> : <?php echo $email; ?></h4>
          </div>
          <?php } ?>
          <h2><?php echo $pseudo; ?></h2>
          <?php } ?>
      <?php
      if(isset($_SESSION['id']) && $_GET['user']==$_SESSION['id'] && !isset($_GET['edit'])){
      ?>
      <div class="edit">
        <a href="profile.php?user=<?php echo $id; ?>&edit" class="btn btn-info">Modifier le profil</a>
      </div>
      <?php } ?>
      </div>
      <div class="petitions_table">
        <div class="petitions_left">
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
            $category=getCategoryById($petition['categoryId']);
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
          <div class="category">
            Catégorie : <a href="index.php?petition=all&category=<?php echo $category['id']; ?>"><?php echo $category['name'] ?></a>
          </div>
          <div class="sign">
            <a href="index.php?petition=<?php echo $petition['id']; ?>" class="btn btn-warning">Voir plus</a>
          </div>
        </div>
        </div>
      <?php
          }
        }
      ?>
      </div>
      <div class="petitions_right">
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
          $category=getCategoryById($petition['categoryId']);
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
            <div class="category">
              Catégorie : <a href="index.php?petition=all&category=<?php echo $category['id']; ?>"><?php echo $category['name'] ?></a>
            </div>
            <div class="sign">
              <a href="index.php?petition=<?php echo $petition['id']; ?>" class="btn btn-warning">Voir plus</a>
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
      ?>
      <?php
        include('footer.php');
      ?>
    </div>
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
