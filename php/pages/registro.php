<?php


?>

<h2>Registro de nuevos usuarios</h2>
<p>Si quieres formar parte del FRB, puedes registrarte como usuario ahora mismo, sin embargo, uno de nuestros administradores tendrá que validar tu usuario para poder tener acceso al contenido extra.</p>
<form class="form-login" action="index.php?page=login" method="post">
    <fieldset>
        <label for="Nombre">Nombre completo</label>
        <br>
        <input type="text" name="Nombre" id="Nombre" required>
        <br>
        <label for="email">Correo electrónico</label>
        <br>
        <input type="email" name="email" id="email">
        <br>
        <label for="Usuario">Nombre de Usuario</label>
        <br>
        <input type="text" name="usuario" id="usuario">
        <br>
        <label for="password">Contraseña</label>
        <br>
        <input type="password" name="password" id="password">
        <br>
        <label for="password2">Repetir Contraseña</label>
        <br>
        <input type="password" name="password2" id="password2">
        <br>
        <input type="submit" value="Registrar usuario">
    </fieldset>
</form>