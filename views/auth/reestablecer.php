<main class="auth">
<h2 class="auth__heading"><?php echo $titulo?></h2>
<p class="auth__texto">Ingresa tu nueva contraseña</p>

<?php require_once __DIR__ . '/../templates/alertas.php'  ?>

<?php if($token_valido){ ?>

<form method="POST" class="formulario">
<div class="formulario__campo">
    <label class="formulario__label" for="password">Nuevo Contraseña</label>
    <input type="password" name="password" class="formulario__input" placeholder="Tu nueva contraseña" id="password">
</div>
<input class="formulario__submit" value="Guardar Contraseña" type="submit">
</form>
<?php } ?>
<div class="acciones">
    <a class="acciones__enlace" href="/login">Ya tienes Cuenta? Inicia Sesión</a>
    <a class="acciones__enlace" href="/registro">Aun no tienes cuenta? Crea una</a>
</div>

</main>