<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
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
            <h1>Košarica</h1>
            <hr>
            <table>
                <tr>
                    <th width="30%">Naziv</th>
                    <th width="10%">Opis</th>
                    <th width="13%">Količina</th>
                    <th width="10%">Jedinična cijena</th>
                    <th width="20%">Cijena</th>
                    <th width="17%"></th>
                </tr>

                <?php
                if(!empty($_SESSION["cart"])){
                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                        ?>
                <tr>
                    <td><?php echo $value["naziv"]; ?></td>
                    <td><?php echo $value["opis"]; ?></td>
                    <td><?php echo $value["kolicina"]; ?></td>
                    <td><?php echo number_format($value["cijena"], 2); ?> EUR</td>
                    <td>
                        <?php echo number_format($value["kolicina"] * $value["cijena"], 2); ?> EUR</td>
                    <td><a href="shop.php?action=delete&id=<?php echo $value["id"]; ?>">
                            <span class="btn btn-danger">Ukloni</span></a></td>
                </tr>
                <?php
                        $total = $total + ($value["kolicina"] * $value["cijena"]);
                    }
                        ?>
                <tr>
                    <td colspan="3"></td>
                    <?php
                    foreach ($_SESSION["cart"] as $key => $value) {
                        $naziv = $value["naziv"];
                        $kolicina = $value["kolicina"];
                        // Add the item details to the cartItems array
                        $cartItems[] = "$naziv x  $kolicina";
    }

    ?>
                </tr>
                <?php
                    }
                ?>
            </table>
            <form class="form" action="add-order.php" method="get" autocomplete="off">
    <input type="text" class="login-input" name="ime" placeholder="Ime" required>
    <input type="text" class="login-input" name="prezime" placeholder="Prezime" required>
    <input type="text" class="login-input" name="telefon" placeholder="Broj telefona" required>
    <input type="text" class="login-input" name="adresa" placeholder="Adresa stanovanja" required>
    <input type="hidden" name="var1" value="<?php echo implode(", ", $cartItems); ?>">
    <input type="hidden" name="var2" value="<?php echo number_format($total, 2); ?>">
        <b>Ukupno: </b><?php echo number_format($total, 2); ?> EUR
    <button type='submit' class='btn btn-success'>Naruči</button>
</form>
        </div>

    </div>

</body>

</html>