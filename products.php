<?php
session_start();
include 'connect-db.php';
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <?php include('html-components/header.html'); ?>
</head>

<body>

    <?php include('html-components/navbar.php'); ?>
    <?php echo "<script>updateNavbar();</script>";?>
    <div class="main-page">
        <div class="main-page-container">

  <?php

if (isset($_POST["add"])){
  if (isset($_SESSION["cart"])){
      $item_array_id = array_column($_SESSION["cart"],"id");
      if (!in_array($_GET["id"],$item_array_id)){
          $count = count($_SESSION["cart"]);
          $item_array = array(
              'id' => $_GET["id"],
              'naziv' => $_POST["hidden-naziv"],
              'opis' => $_POST["hidden-opis"],
              'kolicina' => $_POST["hidden-kolicina"],
              'cijena' => $_POST["hidden-cijena"],
          );
          $_SESSION["cart"][$count] = $item_array;
          echo "<center><div class='alert alert-success alert-dismissible fade show' role='alert'>Proizvod je uspješno dodan u košaricu !
          <span type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </span>
</div></center>";
      }else{
        foreach ($_SESSION["cart"] as $keys => $value) {
          if ($value["id"] == $_GET["id"]) {
              $_SESSION["cart"][$keys]["kolicina"] += $_POST["hidden-kolicina"];
              echo "<center><div class='alert alert-success alert-dismissible fade show' role='alert'>Količina proizvoda je ažurirana u košarici!
              <span type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </span>
              </div></center>";
          }
      }
    }
  }else{
      $item_array = array(
        'id' => $_GET["id"],
        'naziv' => $_POST["hidden-naziv"],
        'opis' => $_POST["hidden-opis"],
        'kolicina' => $_POST["hidden-kolicina"],
        'cijena' => $_POST["hidden-cijena"],
      );
      $_SESSION["cart"][0] = $item_array;
  }
    header("location: products.php");
}

if (isset($_GET["action"])){
  if ($_GET["action"] == "delete"){
      foreach ($_SESSION["cart"] as $keys => $value){
          if ($value["id"] == $_GET["id"]){
              unset($_SESSION["cart"][$keys]);
              header("location: cart.php");
          }
      }
      header("location: products.php");
  }
}
?>
           
            <h1>Trenutna ponuda</h1>
            <hr>
            <div class="proizvodi">
                <?php
            $sql = "SELECT * FROM proizvodi ORDER BY id DESC";
            $result = mysqli_query($con, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                  echo"
                  <div class='card' style='width: 18rem;'>
                  <img class='card-img-top' style='max-height: 300px; object-fit: cover;' src=". $row["slika"] .">
                    <div class='card-body'>
                    <h5 class='card-title'><b>" . $row["naziv"] . "</b><hr></h5>
                    <p class='card-text'>" . $row["opis"] . "</p>
                    </div>
                    <ul class='list-group list-group-flush'>
                    <ul class='list-group-item'><b>Na stanju: </b> "  . $row["kolicina"] . "</ul>
                    <ul class='list-group-item'><b>Cijena: </b> " . $row["cijena"] . " EUR</ul>
                    </ul>
                    <div class='card-body'>
                    ";

                    if (!isset($_SESSION['email'])){ //bilo tko tko nije registriran ili prijavljen
                      echo"
                      <a class='card-link'><button type='button' class='btn btn-warning disabled'>Naručivati mogu samo registrirani korisnici.</button></a>
                      ";
                    }else if($_SESSION['email'] != 'admin@admin.com'){ //ako nije admin
                      echo"
                      <form method='post' action='products.php?id=".$row["id"]."'>
                        <input type='hidden' name='hidden-naziv' value='$row[naziv]'>
                        <input type='hidden' name='hidden-opis' value='$row[opis]'>
                        <input type='number' style='border-radius: 10px; border:1px solid #e3e3e3; float: left; width: 25%;' name='hidden-kolicina' value='1' min='1' max='$row[kolicina]'></input>
                        <input type='hidden' name='hidden-cijena' value='$row[cijena]'>
                        <a class='card-link'><input type='submit' name='add' class='btn btn-primary' value='Kupi'/></button></a>
                      </form>
                      ";
                    }else{ //(preostali slučaj) ako je admin
                      echo"
                      <a href=edit-items.php?id=" . $row['id'] . "><button type='button' class='btn btn-light'>UREDI</button></a>
                      <a href=delete-items.php?id=" . $row['id'] . "><button type='button' class='btn btn-danger'>OBRIŠI</button></a>
                      ";
                    }

                    echo"
                    </div>
                    </div>";
                  
                }
            }else{
              echo "<center><h5>Trenutno nema proizvoda za prodaju.</h5><br/></center>";
            }

            mysqli_close($con);
            ?>
            </div>
        </div>
    </div>
    <hr>
    <center>
                <a href="https://www.facebook.com/patrik.juzbasic.3" target="_blank"><img src="slike/fb.png"
                        width="50px" height="auto"></a>
                <a href="https://www.instagram.com/pa3k.007/" target="_blank"><img src="slike/ig.png" width="50px"
                        height="auto"></a>
    </center>
            <hr>
    <?php include('html-components/footer.html'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>