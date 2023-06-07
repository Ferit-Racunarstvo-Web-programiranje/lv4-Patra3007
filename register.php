<?php
session_start();
if (isset($_SESSION['email'])) {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <?php include('html-components/header.html'); ?>
</head>

<body>

    <?php include('html-components/navbar.php'); ?>


    <div class="main-page">
        <div class="main-page-container">
            <h1>Registracija</h1>
            <hr>

            <?php
      require('connect-db.php');
      if (isset($_REQUEST['username'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $email    = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $password2 = mysqli_real_escape_string($con, $_POST['password2']);
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email' , '" . md5($password) . "')";
        $duplicate = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND email='$email'");

        if (mysqli_num_rows($duplicate) > 0) {
          echo "<center><div class='alert alert-danger alert-dismissible fade show' role='alert'>Korisničko ime i/ili e-mail adresa već postoje !
          <span type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </span>
</div></center>";
        } else if($_POST['password']!= $_POST['password2']){
          echo "<center><div class='alert alert-danger alert-dismissible fade show' role='alert'>Lozinke nisu iste !
          <span type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </span>
</div></center>";
        }else {
          mysqli_query($con, $query);
          echo "<center><div class='alert alert-success alert-dismissible fade show' role='alert'>Uspješno ste registrirani !
          <span type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </span>
</div></center>";
          header('Refresh: 3; login.php');
        }
      }
      ?>

            <form class="form" action="" method="post" autocomplete="off">
                <input type="text" class="login-input" name="username" placeholder="Korisničko ime" required
                    minlength="5">
                <input type="text" class="login-input" name="email" placeholder="Adresa e-pošte" required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                <input type="password" class="login-input" name="password" placeholder="Lozinka" required>
                <input type="password" class="login-input" name="password2" placeholder="Ponovi lozinku" required>
                <input type="submit" name="submit" value="Registriraj se" class="register-button">
                <br>
                <p style="text-align: center;">Već posjedujete račun? Prijavite se <a href="login.php">ovdje</a>.</p>
            </form>
        </div>
    </div>
</body>
</html>