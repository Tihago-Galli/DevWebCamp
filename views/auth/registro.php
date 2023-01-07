<main class="auth">
<h2 class="auth__heading"><?php echo $titulo?></h2>
<p class="auth__texto">Registrate en DevWebCamp</p>

<?php require_once __DIR__ . '/../templates/alertas.php'  ?>

<form method="POST" class="formulario" action="/registro">
<div class="formulario__campo">
    <label class="formulario__label" for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?php echo $usuario->nombre ?>" class="formulario__input" placeholder="Tu Nombre" id="nombre">
</div>

<div class="formulario__campo">
    <label class="formulario__label" for="apellido">Apellido</label>
    <input type="text" name="apellido" value="<?php echo $usuario->apellido ?>" class="formulario__input" placeholder="Tu Apellido" id="apellido">
</div>

<div class="formulario__campo">
    <label class="formulario__label" for="email">Email</label>
    <input type="email" name="email" value="<?php echo $usuario->email ?>" class="formulario__input" placeholder="Tu Email" id="email">
</div>

<div class="formulario__campo">
    <label class="formulario__label" for="password">Contraseña</label>
    <input type="password" name="password" class="formulario__input" placeholder="Tu Contraseña" id="password">
</div>

<div class="formulario__campo">
    <label class="formulario__label" for="password2">Repetir Contraseña</label>
    <input type="password" name="password2" class="formulario__input" placeholder="Tu Contraseña" id="password2">
</div>

<input class="formulario__submit" value="Crear Cuenta" type="submit">
</form>

<div class="acciones">
    <a class="acciones__enlace" href="/login">Ya tienes Cuenta? Inicia Sesión</a>
    <a class="acciones__enlace" href="/olvide">Olvidaste tu contraseña?</a>
</div>

</main>