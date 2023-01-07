
<h2 class="pagina__heading"><?php echo $titulo ?></h2>
<p class="pagina__descripcion">Elije hasta 5 Eventos para asistir de forma presencial.</p>

<div class="eventos-registro">
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias /></h3>
        <p class="eventos-registro__Fecha">Vierner 5 de Octubre</p>

        <div class="eventos-registro__grid">

             <?php foreach($eventos['conferencias_v'] as $evento) {?>
                 <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>

        </div>

        <p class="eventos-registro__Fecha">Sabado 6 de Octubre</p>

<div class="eventos-registro__grid">

     <?php foreach($eventos['conferencias_s'] as $evento) {?>
         <?php include __DIR__ . '/evento.php'; ?>
    <?php } ?>

</div>

<h3 class="eventos-registro__heading--workshops">WorkShops</h3>
        <p class="eventos-registro__Fecha">Vierner 5 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">

             <?php foreach($eventos['workshops_v'] as $evento) {?>
                 <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>

        </div>

        <p class="eventos-registro__Fecha">Sabado 6 de Octubre</p>

<div class="eventos-registro__grid eventos--workshops">

     <?php foreach($eventos['workshops_s'] as $evento) {?>
         <?php include __DIR__ . '/evento.php'; ?>
    <?php } ?>

</div>
</main>

<aside class="registro">
    <h2 class="registro__heading">Tu Registro</h2>
    <div id="registro__resumen" class="registro__resumen"></div>

    <div class="registro__Regalo">
        <label for="regalo" class="registro__label">Selecciona un regalo</label>
        <select class="registro__select" id="regalo">
            <option value="">-- Selecciona tu Regalo --</option>
            <?php foreach($regalos as $regalo){ ?>
                <option value="<?php echo $regalo->id; ?>"><?php echo $regalo->nombre; ?></option>
                <?php }?>
        </select>
    </div>

    <form class="formulario" id="registro" action="">
        <div class="formulario__campo">
            <input type="submit" class="formulario__submit formulario__submit--full" value="Registrarme">
        </div>
    </form>
</aside>
</div>