(function(){

const horas = document.querySelector('#horas');

if(horas){

    //creamos un objeto para almacenar la categoria y el dia del evento
    
    const dias = document.querySelectorAll('[name="dia"]');
    const inputHiddenDia = document.querySelector('[name="dia_id"]');
    const inputHiddenHora = document.querySelector('[name="hora_id"]');
    const categoria = document.querySelector('[name="categoria_id"]');

    categoria.addEventListener('change', terminoBusqueda);
    dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));


    let busqueda = {
        categoria_id: +categoria.value || '',
        dia: +inputHiddenDia.value || ''
    }

    if(!Object.values(busqueda).includes('')){

        (async () => {
            await buscarEventos();

            const id = inputHiddenHora.value;
            //resaltar la hora actual
            const horaSeleccionada = document.querySelector(`[data-hora-id="${id}"]`);
       
            horaSeleccionada.classList.remove('horas__hora--deshabilitado');
            horaSeleccionada.classList.add('horas__hora--seleccionada');

            horaSeleccionada.onclick = seleccionarHora;

        })()
       
    }
    //agremamos al objeto el valor del dia y de la categoria
    function terminoBusqueda(e){
       busqueda[e.target.name] = e.target.value;

       //reiniciar los campos ocultos y el selector de hora
       inputHiddenHora.value = '';
       inputHiddenDia.value = '';

       const horaPrevia = document.querySelector('.horas__hora--seleccionada');

        if(horaPrevia){
            horaPrevia.classList.remove('horas__hora--seleccionada');
        }

       //verificamos que ambos campos se llenen antes de consultar a la API
       if(Object.values(busqueda).includes('')){
        return;
       }

        buscarEventos();
       

       
    }

  async  function buscarEventos(){
    //REalizamos la peticion a la API
    //revizar video 745 al final para filtar album
    const {dia, categoria_id} = busqueda;
        const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;
       
        const resultado = await fetch(url);

        const eventos = await resultado.json();

        

        obtenerHorasDisponibles(eventos);
    }

    function obtenerHorasDisponibles(eventos){

        //reiniciar las horas
        const listadoHoras = document.querySelectorAll('#horas li');
        listadoHoras.forEach(li => li.classList.add('horas__hora--deshabilitado'));
        //comprobar Eventos ya tomados y quitar variable de deshabilitado
        const horasTomadas = eventos.map(evento => evento.hora_id);
        
        //convierte el nodelist en array
        const listadoHorasArray = Array.from(listadoHoras);
            //trae los registros que no incluya el hora_Id seleccionados
        const resultado = listadoHorasArray.filter(li => !horasTomadas.includes(li.dataset.horaId))


     
       
        resultado.forEach(li => li.classList.remove('horas__hora--deshabilitado'));

        //seleccionamos las horas que no tengan la clase horas__hora--deshabilitado
        const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitado)');

       horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarHora));

       
    }

    function seleccionarHora(e){
        //deshabilitar la hora previa
        const horaPrevia = document.querySelector('.horas__hora--seleccionada');

        if(horaPrevia){
            horaPrevia.classList.remove('horas__hora--seleccionada');
        }
        //Agregar clase
        e.target.classList.add('horas__hora--seleccionada');
       
        inputHiddenHora.value = e.target.dataset.horaId;

        //llenar el campo oculto de dia
        inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
       
    }
}


})();

