<?php
session_start();
?>

<?php
include 'connect-db.php';

if ($_SESSION['username']) {

  $id = $_GET['id'];
  $query =  "DELETE FROM kosarica WHERE id='$id'";
  $result = mysqli_query($con, $query);

  if ($result) {
    header("location: kosarica.php");
    exit;
  } else {
    echo "ERROR: " . mysqli_error($con);
  }
}

mysqli_close($con);
?>