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
    <title><?php $GLOBALS['siteName'] ?></title>
  </head>
  <body>
    <div class="container">
      <?php
        include('header.php');
      ?>
      <div class="body">
        <?php
        if (isset($_GET['signup'])) {
        ?>
          <div class="signup">
            <form action="index.php" method="post">
              <input type="text" name="name" placeholder="Name"> <br>
              <input type="text" name="surname" placeholder="Surname"> <br>
              <input type="text" name="pseudo" placeholder="Pseudo"> <br>
              <input type="text" name="email" placeholder="Email"> <br>
              <input type="password" name="password" placeholder="Password"> <br>
              <input type="submit" name="signup" value="Sign Up">
            </form>
          </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['signin'])) {
        ?>
          <div class="signin">
            <form action="index.php" method="post">
              <?php
              if(isset($_GET['startpetitionfail'])){
              ?>
              <textarea readonly="readonly" name="startpetitionfail" class="startpetitionfail" rows="1" cols="100">Connectez vous pour lancer une pétition.</textarea>
              <br>
              <?php
              }
              ?>
              <input type="text" name="email" placeholder="Email"> <br>
              <input type="password" name="password" placeholder="Password"> <br>
              <input type="submit" name="signin" value="Connect">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
  </body>
</html>
