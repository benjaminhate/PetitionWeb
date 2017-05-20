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
        include('accueil.php');
        ?>
        <?php
        include('connect.php');
        ?>
        <?php
        include('petition.php');
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