<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <?php 
    include('config.php');
    include('functions.php');
    ?>
    <title>Test</title>
  </head>
  <body>
    <div class="container">
      <?php
      include('header.php');
      include('body.php');
      include('footer.php');
      /*addCategory(array('name'=>'Test'));
      addUser(array('name'=>'Test','surname'=>'TestSur','pseudo'=>'Kikkoo','mail'=>'kikkoodu31@gmail.com'));
      addPetition(array('title'=>'PetTest','description'=>'Test de petition','recipient'=>'moi','author'=>'Kikkoo','categoryId'=>1,'userId'=>1,'dateEnd'=>10/02/2000,'expSign'=>100));
      addSignature(array('petitionId'=>1,'userId'=>1));*/
      $categories=getCategory(10);
      echo "<p>".$categories['name']."<p>";
      ?>
    </div>
  </body>
</html>
