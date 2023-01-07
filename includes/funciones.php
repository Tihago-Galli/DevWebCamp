<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}


function pagina_actual($path) : bool{
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}

// Función que revisa que el usuario este autenticado
function is_Auth() : bool {
    if(!isset($_SESSION)){
        session_start();
    } 
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}

function iniciarSession() {
    if(!isset($_SESSION)){
        session_start();
    }  
}

function is_Admin() : bool {

    if(!isset($_SESSION)){
        session_start();
    } 
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function aos_animacion() {
    $efectos = ['fade-up', 'fade-down', 'fade-right', 'fade-left', 'flip-left', 'flip-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-out'];

    $efecto = array_rand($efectos, 1);

    echo ' data-aos="'. $efectos[$efecto]. '" ';

}