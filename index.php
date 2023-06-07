<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruit_shop1";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS fruit_shop1";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE TABLE IF NOT EXISTS `proizvodi` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `naziv` varchar(250) NOT NULL,
    `opis` varchar(100) NOT NULL,
    `cijena` double(9,2) NOT NULL,
    `slika` varchar(250) NOT NULL,
    `kolicina` int(10) NOT NULL,
    `objavio` varchar(250) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `opis` (`opis`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS `narudbe` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `ime` varchar(250) NOT NULL,
    `prezime` varchar(100) NOT NULL,
    `telefon` double(9,2) NOT NULL,
    `adresa` varchar(250) NOT NULL,
    `narudzba` double(9,2) NOT NULL,
    `cijena` varchar(250) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS `users` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `username` varchar(250) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT IGNORE INTO `proizvodi` (`naziv`, `opis`, `cijena`, `slika`, `kolicina`, `objavio`) VALUES
    ('Jabuka', 'Crvena i ukusna', 1.99, 'https://media.istockphoto.com/id/184276818/photo/red-apple.jpg?s=612x612&w=0&k=20&c=NvO-bLsG0DJ_7Ii8SSVoKLurzjmV0Qi4eGfn6nW3l5w=', 10, 'Patrik'),
    ('Naranca', 'Socna i slatka', 0.99, 'https://media.istockphoto.com/id/185284489/photo/orange.jpg?s=612x612&w=0&k=20&c=m4EXknC74i2aYWCbjxbzZ6EtRaJkdSJNtekh4m1PspE=', 15, 'Patrik'),
    ('Banana', 'Žuta i zrela', 0.49, 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8a/Banana-Single.jpg/2324px-Banana-Single.jpg', 20, 'Patrik'),
    ('Ananas', 'Sladak i mek', 2.49, 'https://www.biobio.hr/upload/catalog/product/17350/7445.jpg', 20, 'Patrik'),
    ('Mandarina', 'Sladaka i socna', 1.29, 'https://www.biobio.hr/upload/catalog/product/27991/18059.jpg', 20, 'Patrik')";

    

if ($conn->query($sql) === TRUE) {
    echo "Sample data inserted into 'proizvodi' table";
} else {
    echo "Error inserting sample data into 'proizvodi' table: " . $conn->error;
}

$sql = "INSERT IGNORE INTO `users` (`username`, `email`, `password`) VALUES
    ('admin', 'admin@admin.com', '0192023a7bbd73250516f069df18b500')";

if ($conn->query($sql) === TRUE) {
    echo "Sample data inserted into 'users' table";
} else {
    echo "Error inserting sample data into 'users' table: " . $conn->error;
}

$conn->close();
header("Location: shop.php");

?>