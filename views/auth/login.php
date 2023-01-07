<main class="auth">
<h2 class="auth__heading"><?php echo $titulo?></h2>
<p class="auth__texto">Inicia Sesión en DevWebCamp</p>

<?php require_once __DIR__ . '/../templates/alertas.php' ?>

<form method="POST" class="formulario" action="/login">
<div class="formulario__campo">
    <label class="formulario__label" for="email">Email</label>
    <input type="email" name="email" class="formulario__input" placeholder="Tu Email" id="email">
</div>

<div class="formulario__campo">
    <label class="formulario__label" for="password">Contraseña</label>
    <input type="password" name="password" class="formulario__input" placeholder="Tu Contraseña" id="password">
</div>

<input class="formulario__submit" value="Iniciar Sesion" type="submit">
</form>

<div class="acciones">
    <a class="acciones__enlace" href="/registro">Aun no tienes cuenta? Crea una</a>
    <a class="acciones__enlace" href="/olvide">Olvidaste tu contraseña?</a>
</div>

</main>