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

      if(isset($_POST['signin']) && isset($_POST['email']) && isset($_POST['password'])){
        sign_in($_POST['email'],$_POST['password']);
      }
      if(isset($_POST['signup']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['pseudo'])){
        sign_up($_POST['name'],$_POST['surname'],$_POST['pseudo'],$_POST['email'],$_POST['password']);
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
                <input type="password" id="pw2" name="confim_password" placeholder="Confirm Password" class="form-control" oninput="validateSignUpForm()">
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
                <button name="signin" id="buttonSignIn" class="btn btn-lg btn-primary btn-block" type="submit" disabled="disabled">Finaliser</button>
              </div>
            </form>
          </div>
        <?php
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
      pass1.classList.remove("passsuccess");
      pass2.classList.remove("passsuccess");
      if(pass1.value==pass2.value || !pass1.value || !pass2.value){
        pass1.classList.remove("passfail");
        pass2.classList.remove("passfail");
        if(pass1.value==pass2.value && pass1.value && pass2.value){
          pass1.classList.add("passsuccess");
          pass2.classList.add("passsuccess");
          return true;
        }
        return false;
      }else{
        pass1.classList.add("passfail");
        pass2.classList.add("passfail");
        return false;
      }
    }

    function validateSignInForm(){
      var email=document.getElementById("emailIn");
      var password=document.getElementById("pwIn").value;
      var button=document.getElementById("buttonSignIn");
      var regEx=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var checkEmail=regEx.test(email.value);
      if(!checkEmail){
        if(email.value){
          email.classList.add('mailfail');
        }else{
          email.classList.remove('mailfail');
        }
        email.classList.remove('mailsuccess');
      }else{
        email.classList.remove('mailfail');
        email.classList.add('mailsuccess');
      }
      if(!checkEmail || !password){
        button.disabled=true;
      }else{
        button.disabled=false;
      }
    }

    function validateSignUpForm(){
      var name=document.getElementById("name").value;
      var surname=document.getElementById("surname").value;
      var pseudo=document.getElementById("pseudo");
      var email=document.getElementById("emailUp");
      var button=document.getElementById("buttonSignUp");
      var checkPassword=checkPass();
      pseudo.classList.remove('errorPseudoUsed');
      email.classList.remove('errorUserExist');
      var regEx=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var checkEmail=regEx.test(email.value);
      if(!checkEmail){
        if(email.value){
          email.classList.add('mailfail');
        }else{
          email.classList.remove('mailfail');
        }
        email.classList.remove('mailsuccess');
      }else{
        email.classList.remove('mailfail');
        email.classList.add('mailsuccess');
      }
      if(!name || !surname || !pseudo.value || !checkEmail || !checkPassword){
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
