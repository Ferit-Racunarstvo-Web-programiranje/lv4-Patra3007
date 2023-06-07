<?php
session_start();
?>

<?php
include 'connect-db.php';

if ($_SESSION['email'] == 'admin@admin.com') {

  $id = $_GET['id'];
  $query =  "DELETE FROM proizvodi WHERE id='$id'";
  $result = mysqli_query($con, $query);

  if ($result) {
    header("location: index.php");
    exit;
  } else {
    echo "ERROR: " . mysqli_error($con);
  }
}else{
  echo"";
}

mysqli_close($con);

?>