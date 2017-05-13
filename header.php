<div class="header">

  <div class="top-bar">
    <div class="number">
      <i class="fa fa-users" aria-hidden="true"></i>
      Nombres de personnes inscrites : <?php echo getNbSubscribers()['count(*)']; ?>
    </div>
    <div class="top-right-bar">
      <div class="inscription">
      <?php
        if(isset($_SESSION['id'])){
      ?>
        <a href="profile.php" class="btn btn-primary"><?php echo $_SESSION['pseudo'] ?></a>
      <?php
        }else{
      ?>
        <a href="?signup" class="btn btn-warning">Sign Up</a>
      <?php
        }
      ?>
      </div>
      <div class="connection">
      <?php
        if(isset($_SESSION['id'])){
      ?>
        <a href="logout.php" class="btn btn-warning">Logout</a>
      <?php
        }else{
      ?>
        <a href="?signin" class="btn btn-warning">Sign In</a>
      <?php
        }
      ?>
      </div>
    </div>
  </div>
  <div class="main">
    <div class="title">
      <h1><?php echo $GLOBALS['siteName'] ?></h1>
    </div>
    <div class="startpetition">
      <a href="home.php?startpetition">
        <h1 class="text">Lancer une pétiton</h1>
        <i class="fa fa-pencil-square-o fa-5" aria-hidden="true"></i>
      </a>

    </div>
  </div>
  <div class="navigation">
    <div class="menu">
      <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="navbar-collapse collapse" aria-expanded="true" style="">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Accueil</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" aria-expanded="false" aria-haspopup="true"role="button"data-toggle="dropdown" href="#">
                          Pétitions
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="index.php?petition=all">Toutes les pétitions</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle" aria-expanded="false" aria-haspopup="true"role="button"data-toggle="dropdown" href="#">
                          Catégories
                        </a>
                        <ul class="dropdown-menu">
                          <?php
                            $categories=getAllCategories();
                            foreach ($categories as $key => $value) {
                          ?>
                          <li><a href="index.php?petition=all&category=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
                          <?php
                            }
                          ?>
                        </ul>
                    </li>

                </ul>

            </div>

        </div>

    </nav>

    </div>
    <div class="search">
      <form class="navbar-form search" action="index.php" method="get">
        <div class="input-group add-on">
          <input class="form-control" placeholder="Recherche" name="search" type="search">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
