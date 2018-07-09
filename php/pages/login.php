<?php


?>

<h2>Inicio de sesión</h2>
<p>Si ya te has registrado como usuario, inicia sesión con tus credenciales, de lo contrario, por favor, registrate <a href="index.php?page=registro">aquí</a></p>
<form class="form-login" action="index.php?page=login" method="post">
    <fieldset>
        <label for="Usuario">Usuario</label>
        <br>
        <input type="text" name="usuario" id="usuario">
        <br>
        <label for="Contraseña">Contraseña</label>
        <br>
        <input type="password" name="contraseña" id="contraseña">
        <br>
        <input type="submit" value="Iniciar sesion">
    </fieldset>
</form>