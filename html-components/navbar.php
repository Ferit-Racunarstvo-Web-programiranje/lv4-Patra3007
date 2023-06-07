<div class="navbar" id="navbar">
    <ul>
        <li id="x" onclick="fun('navbar')">&#9776;</li>
        <li id="nav-link"><a href="index.php">TRGOVINA</a></li>
        <li id='proizvodi'><a href='products.php'>PROIZVODI</a></li>
        <?php
        if (isset($_SESSION['email'])) {
            
            if(($_SESSION['email'] === 'admin@admin.com')){
                echo "<li id='proizvodi'><a href='orders.php'>NARUDŽBE</a></li>";
                echo "<li style='color: #dba111'><b>$_SESSION[email]</b><li>";
                echo "<li><a href='add-products.php'><button type='button' class='btn btn-light''>Dodaj proizvod</button></a></li>";
            }else{
                if(!empty($_SESSION["cart"])){
                    $cart_count = count(array_keys($_SESSION["cart"]));
                }
                else{
                    $cart_count = 0;
                }
    
                echo "<li id='kosaricaNavbar'><a href='cart.php'>Košarica(". $cart_count .")</a></li>";
                echo "<li style='color: #dba111'><b>$_SESSION[email]</b><li>";
            }
            echo "<li><a href='logout.php'><button type='button' class='btn btn-danger'>Odjava</button></a></li>";
        }else{
            echo "<li><a href='login.php'>Prijava</a></li>";
            echo  "<li><a href='register.php'>Registracija</a></li>";
        }
        ?>
    </ul>
</div>