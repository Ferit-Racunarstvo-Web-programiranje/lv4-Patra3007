<?php
session_start();
?>

<?php
    include 'connect-db.php';

    $naziv = mysqli_real_escape_string($con, $_POST['naziv']);
    $opis    = mysqli_real_escape_string($con, $_POST['opis']);
    $cijena = mysqli_real_escape_string($con, $_POST['cijena']);
    $slika = mysqli_real_escape_string($con, $_POST['slika']);
    $kolicina = mysqli_real_escape_string($con, $_POST['kolicina']);
    $objavio = mysqli_real_escape_string($con, $_POST['objavio']);

    $sql = "INSERT INTO proizvodi (naziv, opis, cijena, slika, kolicina, objavio) VALUES ('$naziv', '$opis' , '$cijena', '$slika', '$kolicina', '$objavio')";

    if(mysqli_query($con, $sql)){
        header("location: index.php");
    } else{
        $message = "ERROR";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    mysqli_close($con);
    
?>