<?php
if(empty($_GET)){
?>
<!-- <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
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
</div> -->

<center>
  <img src="revolution.jpg" height="400" width="800">
</center>


<div class="petitions_table">
  <div class="petitions_left">
    <div class="presentation_petition">
      <h3>Pétitions à la une :</h3>
    </div>
    <?php
      $petitionsRecent=getAllPetitionsRecent();
      if(empty($petitionsRecent)){
    ?>
      <div class="Article_small">
        <div class="noSigned">
          Aucune pétition à présenter.
        </div>
      </div>
    <?php
      }else{
      $petitions=array_slice($petitionsRecent, 0,3);
      foreach ($petitions as $key => $petition) {
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
      <h3>Pétitions urgentes :</h3>
    </div>
    <?php
      $petitions=getAllPetitionsUrg();
      if(empty($petitions)){
    ?>
      <div class="Article_small">
        <div class="noSigned">
          Aucune pétition urgente.
        </div>
      </div>
    <?php
      }else{
      foreach ($petitions as $key => $petition) {
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
</div>
<?php
}
?>