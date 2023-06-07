<?php
session_start();
include 'connect-db.php';
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
            <h1>Narudžbe</h1>
            <hr>
            <table>
                <tr>
                    <th width="10%">Ime</th>
                    <th width="10%">Prezime</th>
                    <th width="20%">Telefon</th>
                    <th width="20%">Adresa</th>
                    <th width="20%">Cijena</th>
                    <th width="17%"></th>
                </tr>
                <?php
                $sql = "SELECT * FROM narudbe ORDER BY id DESC";
            $result = mysqli_query($con, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row["ime"]; ?></td>
                        <td><?php echo $row["prezime"]; ?></td>
                        <td><?php echo $row["telefon"]; ?></td>
                        <td><?php echo $row["adresa"]; ?></td>
                        <td><?php echo number_format($row["cijena"], 2); ?> EUR</td>
                    </tr>
                    <?php
                }
            }
            mysqli_close($con);
            ?>
            </table>

        </div>

    </div>

</body>

</html>