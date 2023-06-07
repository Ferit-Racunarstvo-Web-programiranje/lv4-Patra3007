<?php
session_start();
?>

<?php
include "connect-db.php";

if ($_SESSION['email'] == 'admin@admin.com') {
    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM proizvodi WHERE id='$id'");
    $data = mysqli_fetch_array($query);

    if (isset($_POST['update'])) {
        $naziv = $_POST['naziv'];
        $opis = $_POST['opis'];
        $cijena = $_POST['cijena'];
        $slika = $_POST['slika'];
        $kolicina = $_POST['kolicina'];
        $objavio = $_POST['objavio'];

        $query = mysqli_query($con, "UPDATE proizvodi SET naziv='$naziv', opis='$opis', cijena='$cijena', slika='$slika', kolicina='$kolicina' WHERE id='$id'");

        mysqli_close($con);
        header("location: index.php");
        exit;
    }
} else {
    echo"";
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

        <h1>Ažuriranje proizvoda</h1>
        <hr>
        <br>
        <form method="POST">
            <br>
            <input type="text" name="naziv" value="<?php echo $data['naziv'] ?>" placeholder="Ažuriraj naziv">
            <input type="text" name="opis" value="<?php echo $data['opis'] ?>" placeholder="Ažuriraj opis">
            <input type="number" name="cijena" value="<?php echo $data['cijena'] ?>" placeholder="Ažuriraj cijenu">
            <input type="text" name="slika" value="<?php echo $data['slika'] ?>" placeholder="Ažuriraj URL slike">
            <input type="number" name="kolicina" step=".01" value="<?php echo $data['kolicina'] ?>"
                placeholder="Ažuriraj količinu">
            <input type="text" name="objavio" value="<?php echo $data['objavio'] ?>" placeholder="Objavio">
            <center><input type="submit" name="update" value="Ažuriraj artikl" class="btn btn-dark"></center>
        </form>
    </div>
</body>

</html>