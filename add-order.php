<?php
session_start();
?>

<?php
    include 'connect-db.php';

    foreach ($_SESSION["cart"] as $keys => $value){
            unset($_SESSION["cart"][$keys]);
            header("location: cart.php");
        }
    $ime = $_GET['ime'];
    $prezime    = $_GET['prezime'];
    $telefon = $_GET['telefon'];
    $adresa = $_GET['adresa'];
    $narudba = $_GET['var1'];
    $cijena = $_GET['var2'];

    $sql = "INSERT INTO narudbe (ime, prezime, telefon, adresa, narudzba, cijena) VALUES ('$ime', '$prezime' , '$telefon', '$adresa', '$narudba', '$cijena')";

    echo "<center><div class='alert alert-success alert-dismissible fade show' role='alert'>Uspješno ste registrirani !
    <span type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</span>
</div></center>";
    if(mysqli_query($con, $sql)){
       
        header("location: cart.php");
    } else{
        $message = "ERROR";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    

    
    mysqli_close($con);
    
?>