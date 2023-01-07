<main class="auth">
<h2 class="auth__heading"><?php echo $titulo?></h2>
<p class="auth__texto">Recupera tu acceso a DevWebCamp</p>

<?php require_once __DIR__ . '/../templates/alertas.php'  ?>

<form method="POST" class="formulario" action="/olvide">
<div class="formulario__campo">
    <label class="formulario__label" for="email">Email</label>
    <input type="email" name="email" class="formulario__input" placeholder="Tu Email" id="email">
</div>
<input class="formulario__submit" value="Enviar Email" type="submit">
</form>

<div class="acciones">
    <a class="acciones__enlace" href="/login">Ya tienes Cuenta? Inicia Sesión</a>
    <a class="acciones__enlace" href="/registro">Aun no tienes cuenta? Crea una</a>
</div>

</main>