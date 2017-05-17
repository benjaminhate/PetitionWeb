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

      if(isset($_POST['signin'])){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
          sign_in($_POST['email'],$_POST['password']);
        }else{
          header('Location:index.php?signin&errorNullValue');
        }
      }
      if(isset($_POST['signup'])){
        if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['pseudo'])){
          sign_up($_POST['name'],$_POST['surname'],$_POST['pseudo'],$_POST['email'],$_POST['password'],$_POST['confirm_password']);
        }else{
          header('Location:index.php?signup&errorNullValue');
        }
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
      if(empty($_GET)){
      ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="IMG_1666.JPG">
          </div>
          <div class="item">
            <img src="IMG_2270.JPG">
          </div>
          <div class="item">
            <img src="IMG_2291.JPG">
          </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="fa fa-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="fa fa-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <?php
      }
      ?>
        <?php
        if (isset($_GET['signup'])) {
        ?>
          <div class="signup">
            <form action="index.php" method="post" class="form-signin">
              <div class="fiche">
                <h2 class="form-signin-heading">Incription</h2>
                <?php
                if(isset($_GET['errorNullValue'])){
                ?>
                <div class="alert alert-danger">Un ou plusieurs champs sont vides.</div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['errorPseudoUsed'])){
                ?>
                <div class="alert alert-danger">Le pseudo est déjà utlisé.</div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['errorUserExist'])){
                ?>
                <div class="alert alert-danger">L'adresse email est déjà utlisée.</div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['errorMailIncorrect'])){
                ?>
                <div class="alert alert-danger">L'adresse email est incorrecte.</div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['errorPseudoIncorrect'])){
                ?>
                <div class="alert alert-danger">Le pseudo est trop court.</div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['errorNameIncorrect'])){
                ?>
                <div class="alert alert-danger">Le nom est trop court.</div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['errorSurnameIncorrect'])){
                ?>
                <div class="alert alert-danger">Le prénom est trop court.</div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['errorPassIncorrect'])){
                ?>
                <div class="alert alert-danger">Le mot de passe est trop court.</div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['errorPassNotVerified'])){
                ?>
                <div class="alert alert-danger">Le mot de passe n'est pas identique à sa confirmation.</div>
                <?php
                }
                ?>
                <label for="InputName">Name</label>
                <input type="text" id="name" name="name" placeholder="Name" class="form-control" oninput="validateSignUpForm()">
                <label for="InputSurname">Surname</label>
                <input type="text" id="surname" name="surname" placeholder="Surname" class="form-control" oninput="validateSignUpForm()">
                <label for="InputPseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" class="form-control <?php if(isset($_GET['errorPseudoUsed'])){echo 'errorPseudoUsed';} ?>" oninput="validateSignUpForm()">
                <label for="InputEmail">Email</label>
                <input type="email" id="emailUp" name="email" placeholder="Email" class="form-control <?php if(isset($_GET['errorUserExist'])){echo 'errorUserExist';} ?>" oninput="validateSignUpForm()">
                <label for="InputPassword">Password</label>
                <input type="password" id="pw1" name="password" placeholder="Password" class="form-control" oninput="validateSignUpForm()">
                <label for="InputConfirmPassword">Confirm Password</label>
                <input type="password" id="pw2" name="confirm_password" placeholder="Confirm Password" class="form-control" oninput="validateSignUpForm()">
              </div>
              <br>
              <div class="click">
                <button name="signup" id="buttonSignUp" class="btn btn-lg btn-primary btn-block" type="submit" disabled="disabled">Finaliser</button>
              </div>
            </form>
          </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['signin'])) {
        ?>
          <div class="signin">
            <form action="index.php" method="post" class="form-signin">
              <div class="fiche">
                <h2 class="form-signin-heading">Se connecter</h2>
                <?php
                if(isset($_GET['startpetitionfail'])){
                ?>
                <div class="alert alert-success">
                  Connectez vous pour lancer une pétition.
                  <input type="hidden" name="startpetitionfail">
                </div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['msg'])){
                ?>
                <div class="alert alert-danger">Email ou mot de passe invalide.</div>
                <?php
                }
                ?>
                <label for="InputEmail">Email</label>
                <input type="text" id="emailIn" name="email" placeholder="Email" class="form-control" oninput="validateSignInForm()">
                <label for="InputPassword">Password</label>
                <input type="password" id="pwIn" name="password" placeholder="Password" class="form-control" oninput="validateSignInForm()">
              </div>
              <br>
              <div class="click">
                <button name="signin" id="buttonSignIn" class="btn btn-lg btn-primary btn-block" type="submit" disabled="disabled">Connexion</button>
              </div>
            </form>
          </div>
        <?php
        }
        ?>
        <?php
if(isset($_GET['petition'])){
  if($_GET['petition']=='all'){
    $petitions=getAllPetitions();
    if(isset($_GET['category'])){
      $petitions=getAllPetitionsByCategory($_GET['category']);
    }
    if(isset($_GET['user'])){
      $petitions=getAllPetitionsByUser($_GET['user']);
    }
    if(isset($_GET['search'])){
      $petitions=searchInPetitions($_GET['search']);
    }
    if(isset($_GET['recent'])){
      $petitions=getAllPetitionsRecent();
    }
    if(isset($_GET['urg'])){
      $petitions=getAllPetitionsUrg();
    }
    if(isset($_GET['finish'])){
      $petitions=getAllPetitionsfinish();
    }
    if(isset($_GET['success'])){
      $petitions=getAllPetitionssuccess();
    }
    if(isset($_GET['alea'])){
      $petitions=getPetitionAlea();
    }
    if(empty($petitions)){
      ?>
      <div class="petitionEmpty">Aucune pétition trouvée.</div>
      <?php
    }else{
      foreach ($petitions as $key => $petition) {
        $user=getUserById($petition['userId']);
        ?>
        <div class="Article">
          <div class="etage">
            <div class="titre">
            <a href="index.php?petition= <?php echo $petition['id'] ?>"><h4><?php echo $petition['title'] ?></h4></a>
            </div>
            <div class="author">
              <p class="blog-post-meta"> <?php echo date("d/m/Y",strtotime($petition['dateBegin'])) ?> by <a href="index.php?petition=all&user=<?php echo $user['id']?>"><?php echo $user['pseudo']; ?></a></p>
            </div>
          </div>
          <div class="shortDescription">
            <?php
              if(strlen($petition['description'])<150){
                echo $petition['description'];
              }else{
                echo substr($petition['description'],0,150);
                echo '...';
              }
             ?>
          </div>
          <div class="progress">
            <?php
            if(empty($petition['expSign'])){
              ?>
              <div class="progress-bar progress-bar-striped" role="progressbar"  style="width: 100%;background-color:grey;" ><span class="sr-only"></span></div>
              <?php
            }else {
              if($petition['nbSign']<$petition['expSign']){
                $percentValue=intval($petition['nbSign'])/intval($petition['expSign'])*100;
                ?>
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $petition['nbSign']?>" aria-valuemin="0" aria-valuemax="<?php echo $petition['expSign']?>" style="width: <?php echo $percentValue?>%"><span class="sr-only"></span></div>
                <?php
              }else{
                ?>
                <div class="progress-bar progress-bar-success" role="progressbar" style="width: 100%"><span class="sr-only"></span></div>
                <?php
              }
            }
            ?>
        </div>
        <div class="etage">
          <div class="numberSign">
            <i class="fa fa-users" aria-hidden="true"></i>
            <?php echo $petition['nbSign'] ?> signatures
          </div>
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
  }else{
    $petition=getPetitionById($_GET['petition']);
    if(empty($petition)){
      ?>
      <div class="petitionEmpty">Aucune pétition trouvée.</div>
      <?php
    }else{
      $user=getUserById($petition['userId']);
      $category=getCategoryById($petition['categoryId']);
      ?>
      <div class="AllArticle">
        <div class="Title">
          <h1><?php echo $petition['title'] ?></h1>
        </div>
        <div class="group">
          <div class="DateandAuthor">
            <p class="blog-post-meta"> <?php echo date("d/m/Y",strtotime($petition['dateBegin'])) ?> by <a href="index.php?petition=all&user=<?php echo $user['id']?>"><?php echo $user['pseudo']; ?></a></p>
          </div>
          <div class="Categorie">
            Categorie : <?php echo $category['name'] ?>
          </div>
        </div>
        <div class="Description">
          <?php echo $petition['description'] ?>
        </div>
        <div class="progress">
          <?php
          if(empty($petition['expSign'])){
            ?>
            <div class="progress-bar progress-bar-striped" role="progressbar"  style="width: 100%;background-color:grey;" ><span class="sr-only"></span></div>
            <?php
          }else {
            if($petition['nbSign']<$petition['expSign']){
              $percentValue=intval($petition['nbSign'])/intval($petition['expSign'])*100;
              ?>
              <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $petition['nbSign']?>" aria-valuemin="0" aria-valuemax="<?php echo $petition['expSign']?>" style="width: <?php echo $percentValue?>%"><span class="sr-only"></span></div>
              <?php
            }else{
              ?>
              <div class="progress-bar progress-bar-success" role="progressbar" style="width: 100%"><span class="sr-only"></span></div>
              <?php
            }
          }
          ?>
          </div>
          <div class="group">
            <div class="numberSign">
            <i class="fa fa-users" aria-hidden="true"></i>
             <?php echo $petition['nbSign'] ?> signatures
            </div>
            <div class="dateEnd">
              <?php
              if(!empty($petition['dateEnd'])){
                echo "Date de fin : ";
                echo date("d/m/Y",strtotime($petition['dateEnd']));
              }
              ?>
            </div>
          </div>
        <div class="Sign">
          <button type="button" class="btn btn-warning" id="buttonsign">Signe-Moi</button>
        </div>
      </div>
      <?php
    }
  }
}
         ?>
        </div>
      <?php
        include('footer.php');
      ?>
    </div>

    <script type="text/javascript">
    function checkPass(){
      var pass1=document.getElementById("pw1");
      var pass2=document.getElementById("pw2");
      pass1.classList.remove("success");
      pass2.classList.remove("success");
      if((pass1.value==pass2.value && pass1.value.length>5) || !pass1.value || !pass2.value){
        pass1.classList.remove("fail");
        pass2.classList.remove("fail");
        if(pass1.value==pass2.value && pass1.value.length>5 && pass2.value.length>5){
          pass1.classList.add("success");
          pass2.classList.add("success");
          return true;
        }
        return false;
      }else{
        pass1.classList.add("fail");
        pass2.classList.add("fail");
        return false;
      }
    }

    function validateSignInForm(){
      var email=document.getElementById("emailIn").value;
      var password=document.getElementById("pwIn").value;
      var button=document.getElementById("buttonSignIn");
      if(!email || !password){
        button.disabled=true;
      }else{
        button.disabled=false;
      }
    }

    function validateSignUpForm(){
      var name=document.getElementById("name");
      var surname=document.getElementById("surname");
      var pseudo=document.getElementById("pseudo");
      var email=document.getElementById("emailUp");
      var button=document.getElementById("buttonSignUp");
      var checkPassword=checkPass();
      pseudo.classList.remove('errorPseudoUsed');
      email.classList.remove('errorUserExist');
      var regEx=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var checkEmail=regEx.test(email.value);
      var checkName=name.value.length>1;
      var checkSurname=surname.value.length>1;
      var checkPseudo=pseudo.value.length>1;
      if(!checkEmail){
        if(email.value){
          email.classList.add('fail');
        }else{
          email.classList.remove('fail');
        }
        email.classList.remove('success');
      }else{
        email.classList.remove('fail');
        email.classList.add('success');
      }
      if(!checkPseudo){
        if(pseudo.value){
          pseudo.classList.add('fail');
        }else{
          pseudo.classList.remove('fail');
        }
        pseudo.classList.remove('success');
      }else{
        pseudo.classList.remove('fail');
        pseudo.classList.add('success');
      }
      if(!checkName){
        if(name.value){
          name.classList.add('fail');
        }else{
          name.classList.remove('fail');
        }
        name.classList.remove('success');
      }else{
        name.classList.remove('fail');
        name.classList.add('success');
      }
      if(!checkSurname){
        if(surname.value){
          surname.classList.add('fail');
        }else{
          surname.classList.remove('fail');
        }
        surname.classList.remove('success');
      }else{
        surname.classList.remove('fail');
        surname.classList.add('success');
      }
      if( !checkName || !checkSurname || !checkPseudo || !checkEmail || !checkPassword){
        button.disabled=true;
      }else{
        button.disabled=false;
      }
    }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
  </body>
</html>