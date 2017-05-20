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
        <label for="InputName">Nom <small>(minimum 2 caractères)</small></label>
        <input type="text" id="name" name="name" placeholder="Nom" class="form-control" oninput="validateSignUpForm()" autofocus>
        <label for="InputSurname">Prénom <small>(minimum 2 caractères)</small></label>
        <input type="text" id="surname" name="surname" placeholder="Prénom" class="form-control" oninput="validateSignUpForm()">
        <label for="InputPseudo">Pseudo <small>(minimum 2 caractères)</small></label>
        <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" class="form-control <?php if(isset($_GET['errorPseudoUsed'])){echo 'errorPseudoUsed';} ?>" oninput="validateSignUpForm()">
        <label for="InputEmail">Email</label>
        <input type="email" id="emailUp" name="email" placeholder="Email" class="form-control <?php if(isset($_GET['errorUserExist'])){echo 'errorUserExist';} ?>" oninput="validateSignUpForm()">
        <label for="InputPassword">Mot de passe <small>(minimum 6 caractères)</small></label>
        <input type="password" id="pw1" name="password" placeholder="MdP" class="form-control" oninput="validateSignUpForm()">
        <label for="InputConfirmPassword">Confirmer le mot de passe</label>
        <input type="password" id="pw2" name="confirm_password" placeholder="Confirmer MdP" class="form-control" oninput="validateSignUpForm()">
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
        if(isset($_GET['signpetitionfail'])){
        ?>
        <div class="alert alert-success">
          Connectez vous pour signer la pétition.
          <input type="hidden" name="signpetitionfail" value="<?php echo $_GET['signpetitionfail'] ?>">
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
        <input type="text" id="emailIn" name="email" placeholder="Email" class="form-control" oninput="validateSignInForm()" autofocus>
        <label for="InputPassword">Mot de passe</label>
        <input type="password" id="pwIn" name="password" placeholder="MdP" class="form-control" oninput="validateSignInForm()">
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