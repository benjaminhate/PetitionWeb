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
      if(isset($_POST['createPetition'])){
        $redirectDate=false;
        $redirectSign=false;
        if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['category'])){
          $infos = array('title' => $_POST['title'], 'description' => $_POST['description'], 'categoryId' => $_POST['category'], 'userId' => $id);
          if(!empty($_POST['dayEnd']) || !empty($_POST['monthEnd']) || !empty($_POST['yearEnd'])){
            $checkDate=mktime(0,0,0,intval($_POST['monthEnd']),intval($_POST['dayEnd']),intval($_POST['yearEnd']));
            if(empty($_POST['dayEnd']) || empty($_POST['monthEnd']) || empty($_POST['yearEnd'])){
              $redirectDate=true;
            }else{
              $infos['dateEnd']=$checkDate;
            }
          }else{
            $infos['dateEnd']='NULL';
          }
          if(!empty($_POST['expSign'])){
            $expSign=intval($_POST['expSign']);
            if(is_int($expSign) && $expSign>0){
              $infos['expSign']=$_POST['expSign'];
            }else{
              $redirectSign=true;
            }
          }else{
            $infos['expSign']='NULL';
          }
          if($redirectDate){
            header('Location:home.php?startpetition&errorDate');
          }elseif ($redirectSign) {
            header('Location:home.php?startpetition&errorSign');
          }else{
            $connect=connection();
            $infos['title']=mysqli_real_escape_string($connect,$infos['title']);
            $infos['description']=mysqli_real_escape_string($connect,nl2br($infos['description']));
            $infos['nbSign']=0;
            addPetition($infos);
            header('Location:index.php?petition=all');
          }
        }else{
          header('Location:home.php?startpetition&errorNullValue');
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
      	if(isset($_GET['startpetition'])){
      ?>
          <div class="createPetition">
          <?php
          if(isset($_GET['errorNullValue'])){
          ?>
          <div class="alert alert-danger">Un ou plusieurs champs sont vides.</div>
          <?php
            }
          ?>
          <?php
            if(isset($_GET['errorDate'])){
          ?>
          <div class="alert alert-danger">La date est incorrecte ou incomplète.</div>
          <?php
            }
          ?>
          <?php
            if(isset($_GET['errorSign'])){
          ?>
          <div class="alert alert-danger">Le nombre de signatures attendues doit être un entier supérieur à 0.</div>
          <?php
            }
          ?>
            <form action="home.php" method="post">
              <div class="form-group">
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Titre" oninput="validatePetition()">
              </div>
              <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description" placeholder="Description" cols="50" rows="10" class="form-control" oninput="validatePetition()" style="resize: none;"></textarea>
              </div>
              <div class="form-group">
              <label for="date"> Date de fin : </label>
              <br>
              <input type="date" name="dayEnd" placeholder="Jour" class="form-control date"> <b style="font-size: 20px;">/</b>
              <input type="date" name="monthEnd" placeholder="Mois" class="form-control date"> <b style="font-size: 20px;">/</b>
              <input type="date" name="yearEnd" placeholder="Année" class="form-control date"> <br>
              </div>
              <div class="form-group">
                <label for="number"> Nombre de signatures attendues : </label>
                <input type="number" name="expSign" placeholder="Signatures attendues" class="form-control" min="0">
              </div>
              <div class="form-group">
              <label for="category"> Catégorie : </label>
              <br>
                <select name="category" class="form-control">
                  <?php
                    $categories=getAllCategories();
                    foreach ($categories as $key => $category) {
                  ?>
                  <option value="<?php echo $category['id'] ?>"><?php echo $category['name']; ?></option>
                  <?php
                    }
                  ?>
                </select>
                </div>
                 <br>
              <div class="click">
                <button name="createPetition" id="postpetition" class="btn btn-lg btn-primary btn-block" type="submit" disabled="disabled">Submit Petition</button>
              </div>
            </form>
          </div>
          <?php } ?>
      </div>
      <?php
        include('footer.php');
      ?>
    </div>

    <script type="text/javascript">
      function validatePetition(){
        var title=document.getElementById('title');
        var description=document.getElementById('description');
        var submitBtn=document.getElementById('postpetition');
        if(title.value && description.value){
          submitBtn.disabled=false;
        }else{
          submitBtn.disabled=true;
        }
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
</body>
</html>