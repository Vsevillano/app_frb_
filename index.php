<?php
    ob_start();

    session_start();
      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="shortcut icon" href="images/escudo_azuaga.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Galada|Knewave|Luckiest+Guy|Shrikhand" rel="stylesheet">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jssor.slider.min.js"></script>
    <title>FRB - Ultas del Azuaga</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo-box">
                <a href="index.php">
                    <img src="images/logo_frb.png">
                </a>
            </div>
      
            <?php
                include('php/includes/nav.php');
            ?>
        </div>
    </header>
    <div class="contenido">
        <main>
            <?php
            include('php/includes/main.php');
            ?>
        </main>
        <aside>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem doloremque exercitationem eos officiis necessitatibus et dicta quas placeat inventore repudiandae totam, accusamus cupiditate atque unde dolorem illo architecto. A, laudantium.</p>
        </aside>
    </div>
    <footer>
        <p>Aplicación Frente Rojiblanco. Desarrollo por Victoriano Sevillano Vega</p>
        <div class="social">
            <img src="images/001-facebook-logo-button.svg" alt="Facebook">
            <img src="images/002-instagram-logo.svg" alt="Instagram">
            <img src="images/003-twitter-logo-button.svg" alt="Twitter">
        </div>
    </footer>
</body>
</html>
<?php 
	ob_end_flush();
?>