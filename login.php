<?php
session_start();
if (isset($_SESSION['email'])){
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
            <h1>Prijava</h1>
            <hr>

            <?php
    include 'connect-db.php';
    if (isset($_POST['email'])) {
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $password = mysqli_real_escape_string($con, $_POST['password']);
      $query    = "SELECT * FROM users WHERE email = '$email' AND password = '" . md5($password) . "'";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));
      $row = mysqli_num_rows($result);
      if ($row == 1) {
        $_SESSION['email'] = $email;
        header("Location: index.php");
      }else {
        echo "<center><div class='alert alert-danger alert-dismissible fade show' role='alert'>Adresa e-pošte ime i/ili lozinka nisu točni.
          <span type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </span>
</div></center>";
      }
    }
    ?>

            <form class="form" method="post" name="login" autocomplete="off">
                <input type="text" class="login-input" name="email" placeholder="Adresa e-pošte" autofocus="true"
                    required minlength="2">
                <input type="password" class="login-input" name="password" placeholder="Lozinka" required>

                <input type="submit" value="Prijavi se" name="submit" class="login-button">
            </form>
            <br>
            <p style="text-align: center;">Nemate račun? Registrirajte se <a href="register.php">ovdje</a>.</p>

        </div>
    </div>

</body>

</html>