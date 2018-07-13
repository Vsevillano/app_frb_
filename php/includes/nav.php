<?php

if(isset($_SESSION['login'])) {

    if($_SESSION['login']['Perfil'] == 'Admin') {

?>
    <nav>
        <ul>
            <li><a href="index.php?page=inicio">Inicio</a></li>
            <li><a href="index.php?page=historia">Historia</a></li>
            <li><a href="index.php?page=frente">FRB</a></li>
            <li><a href="index.php?page=contacto">Contacto</a></li>
            <li><a href="index.php?page=gestion">Gestion</a></li>
            <li><a href="index.php?page=logout">Logout</a></li>
        </ul>
    </nav>

<?php
    }

    if($_SESSION['login']['Perfil'] == 'User') {

        ?>
            <nav>
                <ul>
                    <li><a href="index.php?page=inicio">Inicio</a></li>
                    <li><a href="index.php?page=historia">Historia</a></li>
                    <li><a href="index.php?page=frente">FRB</a></li>
                    <li><a href="index.php?page=contacto">Contacto</a></li>
                    <li><a href="index.php?page=Pagos">Pagos</a></li>
                    <li><a href="index.php?page=logout">Logout</a></li>
                </ul>
            </nav>
        
        <?php
    }
}
else {
?>

    <nav>
        <ul>
            <li><a href="index.php?page=inicio">Inicio</a></li>
            <li><a href="index.php?page=historia">Historia</a></li>
            <li><a href="index.php?page=frente">FRB</a></li>
            <li><a href="index.php?page=contacto">Contacto</a></li>
            <li><a href="index.php?page=login">Login</a></li>
        </ul>
    </nav>

<?php
}
?>