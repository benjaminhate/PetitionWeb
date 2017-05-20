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
              <p class="blog-post-meta"> <?php echo date("d/m/Y",strtotime($petition['dateBegin'])) ?> par <a href="profile.php?user=<?php echo $user['id']?>"><?php echo $user['pseudo']; ?></a></p>
            </div>
          </div>
          <div class="shortDescription">
            <?php
              if(strlen($petition['description'])<150){
                echo str_replace('\r\n', '<br>', $petition['description']);
              }else{
                $shortDes=substr($petition['description'],0,160);
                echo str_replace('\r\n', '<br>', $shortDes);
                echo '...';
              }
             ?>
          </div>
          <div class="progress" <?php if(empty($petition['expSign'])){echo 'style="visibility: hidden;"';} ?>>
            <?php
            if(empty($petition['expSign'])){
              ?>
              <div class="progress-bar progress-bar-striped" role="progressbar"  style="width: 0%;background-color:grey;" ><span class="sr-only"></span></div>
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
            <a href="index.php?petition=<?php echo $petition['id']; ?>" class="btn btn-warning">Voir plus</a>
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
            <p class="blog-post-meta"> <?php echo date("d/m/Y",strtotime($petition['dateBegin'])) ?> par <a href="profile.php?user=<?php echo $user['id']?>"><?php echo $user['pseudo']; ?></a></p>
          </div>
          <div class="Categorie">
            Catégorie : <a href="index.php?petition=all&category=<?php echo $category['id']; ?>"><?php echo $category['name'] ?></a>
          </div>
        </div>
        <div class="Description">
          <?php echo str_replace('\r\n', '<br>', $petition['description']); ?>
        </div>
        <div class="progress" <?php if(empty($petition['expSign'])){echo 'style="visibility: hidden;"';} ?>>
          <?php
          if(empty($petition['expSign'])){
            ?>
            <div class="progress-bar progress-bar-striped" role="progressbar"  style="width: 0%;background-color:grey;" ><span class="sr-only"></span></div>
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
          <?php
            date_default_timezone_set('Europe/Paris');
            $time=date('Y-m-d H:i:s');
            if(empty($petition['dateEnd'])){
              $disable=false;
            }else{
              $disable=$petition['dateEnd']<$time;
            }
            if(isset($_SESSION['id'])){
          ?>
            <?php
              $checkSign=getSignature($_SESSION['id'],$petition['id']);
              if (empty($checkSign)) {
            ?>
              <a href="sign_petition.php?petition=<?php echo $petition['id']; ?>" class="btn btn-warning" id="buttonsign" <?php if($disable){echo "disabled='disabled'";} ?>>Signe-Moi</a>
            <?php
              }else{
            ?>
              <a href="sign_petition.php?petition=<?php echo $petition['id']; ?>" class="btn btn-danger" id="buttonsign" <?php if($disable){echo "disabled='disabled'";} ?>>Enlever la signature</a>
            <?php
              }
            ?>
          <?php
            }else{
          ?>
            <a href="sign_petition.php?petition=<?php echo $petition['id']; ?>" class="btn btn-warning" id="buttonsign" <?php if($disable){echo "disabled='disabled'";} ?>>Signe-Moi</a>
          <?php
            }
          ?>
        </div>
      </div>
<?php
    }
  }
}
?>