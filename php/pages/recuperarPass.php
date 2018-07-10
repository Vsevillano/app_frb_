<?php


?>

<h2>Recuperar contraseña</h2>
<p>Si ya te has registrado como usuario y no recuerdas tu contraseña, se te enviará un correo donde podrás recuperarla.</p>
<form class="form-login" action="index.php?page=recuperarPass" method="post">
    <fieldset>
        <label for="email">Correo electrónico</label>
        <br>
        <input type="email" name="correo">
        <br>
        <input type="submit" value="Recuperar contraseña">
    </fieldset>
</form>