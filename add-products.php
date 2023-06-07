<?php
session_start();
if($_SESSION['email'] != 'admin@admin.com'){
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

    <div class="main-page" style="padding-top: 5%;">
        <div class="main-page-container">
            <h1>Dodaj novi proizvod</h1>
            <hr>
            <form action="javascript:void(0)" method="POST" id="noviProizvod" autocomplete="off">
                <input id="naziv" type="text" class="login-input" name="naziv" placeholder="Naziv" required>
                <input id="opis" type="text" class="login-input" name="opis" placeholder="Opis" required>
                <input id="cijena" type="number" min="0" step=".01" class="login-input" name="cijena"
                    placeholder="Cijena" required>
                <input id="slika" type="text" class="login-input" name="slika" placeholder="URL slike" required>
                <input id="kolicina" type="number" step=".01" min="1" max="255" class="login-input" name="kolicina"
                    placeholder="Količina" required>
                <input id="objavio" type="text" class="login-input" name="objavio" placeholder="Kontakt mail" required>

                <input type="submit" name="submit" id="submit" class="add-product-button" value="Dodaj">
                <script src="javascript/preventRefreshSerialize.js"></script>
            </form>
</body>

</html>