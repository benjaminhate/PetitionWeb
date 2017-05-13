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
        if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['category'])){
          $infos = array('title' => $_POST['title'], 'description' => $_POST['description'], 'categoryId' => $_POST['category'], 'userId' => $id);
          if(!empty($_POST['dayEnd']) || !empty($_POST['monthEnd']) || !empty($_POST['yearEnd'])){
            $checkDate=mktime(0,0,0,intval($_POST['dayEnd']),intval($_POST['monthEnd']),intval($_POST['yearEnd']));
            if(empty($_POST['dayEnd']) || empty($_POST['monthEnd']) || empty($_POST['yearEnd'])){
              header('Location:home.php?startpetition&errorDate');
            }else{
              $infos['dateEnd']=$checkDate;
            }
          }else{
            $infos['dateEnd']='NULL';
          }
          if(!empty($_POST['expSign'])){
            $infos['expSign']=$_POST['expSign'];
          }else{
            $infos['expSign']='NULL';
          }
          addPetition($infos);
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
        <?php
          if(isset($_GET['errorNullValue'])){
        ?>
        <div class="alert alert-danger">Un ou plusieurs champs sont vides.</div>
        <?php
          }
        ?>




                <div class="createPetition">

            <form action="home.php" method="post">

              <div class="form-group">
                <label for="title">Title :</label>
                <input type="text" name="title" class="form-control" placeholder="Title">
              </div>
              <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" placeholder="Description" cols="50" rows="10" class="form-control"></textarea>
              </div>
              <div class="form-group">
              <label for="date"> End Date : </label>
              <br>
              <input type="date" name="dayEnd" placeholder="End day"> /
              <input type="date" name="monthEnd" placeholder="End month"> /
              <input type="date" name="yearEnd" placeholder="End year"> <br>
              </div>


              <div class="form-group">
                <label for="number"> Number : </label>
                <input type="number" name="expSign" placeholder="Signs expected" class="form-control">
              </div>
              <div class="form-group">
              <label for="category"> Categories : </label>
              <br>
                <select name="category">
                  <?php
                    $categories=getAllCategories();
                    foreach ($categories as $key => $category) {
                  ?>
                  
                  <br>
                  <option value="<?php echo $category['id'] ?>"><?php echo $category['name']; ?></option>
                  <?php
                    }
                  ?>

                </select>
                </div>
                 <br> <br>
              <div class="click">
                <button name="createPetition" id="postpetition" class="btn btn-lg btn-primary btn-block" type="submit">Submit Petition</button>
              </div>

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