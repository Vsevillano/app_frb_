<?php


?>

<h2>Registro de nuevos usuarios</h2>
<p>Si quieres formar parte del FRB, puedes registrarte como usuario ahora mismo, sin embargo, uno de nuestros administradores tendrá que validar tu usuario para poder tener acceso al contenido extra.</p>
<form class="form-login" action="" method="post">
    <fieldset>
        <label for="Nombre">Nombre completo</label>
        <br>
        <input type="text" name="Nombre" id="nombre-reg">
        <br>
        <label for="email">Correo electrónico</label>
        <br>
        <input type="email" name="email" id="email-reg">
        <br>
        <label for="Usuario">Nombre de Usuario</label>
        <br>
        <input type="text" name="usuario" id="usuario-reg">
        <br>
        <label for="password">Contraseña</label>
        <br>
        <input type="password" name="password" id="password-reg">
        <br>
        <label for="password2">Repetir Contraseña</label>
        <br>
        <input type="password" name="password2" id="password2-reg">
        <br>
        <span class="error-reg" style="color:red;"><p></p></span>
        <input type="submit" class="submit" disabled value="Registrar">
    </fieldset>
</form>