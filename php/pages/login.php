<?php

    require_once('php/clases/Login.php');

    if(isset($_SESSION['login'])) {
        header('Location: index.php?page=inicio');
    }

    $error = '';

    if(isset($_POST['login'])){
        $var = Login::singleton_login();
        $perfil = $var->loginUsuario($_POST['usuario'], $_POST['password']);
        
        switch ($perfil['Perfil']) {
            case 'Admin':
                $_SESSION['login'] = $perfil;
                header('Location: index.php?page=inicio');
                break;
            case 'User':
                $_SESSION['login'] = $perfil;
                header('Location: index.php?page=inicio');
                break;
            default:
                $error = "Usuario o contraseña incorrecta";
            break;
        }
	}

?>

<h2>Inicio de sesión</h2>
<p>Si ya te has registrado como usuario, inicia sesión con tus credenciales, de lo contrario, por favor, <a href="index.php?page=registro">registrate</a></p>
<form class="form-login" action="index.php?page=login" method="post">
    <fieldset>
        <label for="Usuario">Usuario</label>
        <br>
        <input type="text" name="usuario" id="user-login">
        <br>
        <label for="Contraseña">Contraseña</label>
        <br>
        <input type="password" name="password" id="pass-login">
        <br>
        <span class="error-login" style="color:red;"><p><?php echo $error;?></p></span>
        <input type="submit" class="submit" name="login" value="Login">
    </fieldset>
    
    <p><a href="index.php?page=recuperarPass">¿Olvidó su contraseña?</a></p>
</form>