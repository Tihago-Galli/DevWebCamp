<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Ponente;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {

    public static function index(Router $router){

        if(!is_Admin()){
            header('Location: /login');
        }

        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        //Comprobamos de que la pagina sea un numero y mayor a 1
        if(!$pagina_actual || $pagina_actual < 1){
            header('Location: /admin/ponentes?page=1');
        }
        
        $registros_por_pagina = 5;
        $total = Ponente::total();

        $paginacion = new Paginacion( $pagina_actual, $registros_por_pagina, $total);
        
        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/ponentes?page=1');
        }

        $ponentes = Ponente::paginacion($registros_por_pagina, $paginacion->offset());

        $router->render('/admin/ponentes/index', [
            "titulo" => "Ponentes / Conferencias",
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router){

        if(!is_Admin()){
            header('Location: /login');
        }
        $alertas = [];
        $ponente = new Ponente;

        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(!is_Admin()){
                header('Location: /login');
            }

            //leer imagen

            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpeta_imagenes = '../public/img/speakers';

                //crear la carpeta imagenes
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);
           
                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            }
            //CONVERTIMOS EL ARRAY EN UN JSON PARA INSERTARLO EN LA BD, 
            //Y ESCAPAMOS LOS SLASHES PARA QUE NO SE PIERDA LA URL
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            $ponente->sincronizar($_POST);



            //validamos
            $alertas = $ponente->validar();

            //Guardar registro
            if(empty($alertas)){

                //Guardar Imagenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                
                $resultado = $ponente->guardar();

                if($resultado){
                    header('Location: /admin/ponentes');
                }
            }
        }
        $router->render('/admin/ponentes/crear', [
            "titulo" => "Registrar Ponente",
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function editar(Router $router){

        if(!is_Admin()){
            header('Location: /login');
        }
        $alertas = [];
        //validar Id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if(!$id){
            header('Location: /admin/ponentes');
        }

        $ponente = Ponente::find($id);

        if(!$ponente){
            header('Location: /admin/ponentes');
        }

        $ponente->imagen_actual = $ponente->imagen;

        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(!is_Admin()){
                header('Location: /login');
            }

            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpeta_imagenes = '../public/img/speakers';

                   // Eliminar la imagen previa
             unlink($carpeta_imagenes . '/' . $ponente->imagen_actual . ".png" );
             unlink($carpeta_imagenes . '/' . $ponente->imagen_actual . ".webp" );

                //crear la carpeta imagenes
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true);
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);
           
                $nombre_imagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombre_imagen;
            }else{
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();

            if(empty($alertas)){
                //Guardar Imagenes
                if(isset($nombre_imagen)){
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                }
                $resultado = $ponente->guardar();

                if($resultado){
                    header('Location: /admin/ponentes');
                }
            }

        }

        $router->render('/admin/ponentes/editar', [
            "titulo" => "Actualizar Ponente",
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    public static function eliminar(){

        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(!is_Admin()){
                header('Location: /login');
            }

            $id = $_POST['id'];

            $ponente = Ponente::find($id);

            if(!isset($ponente)){
                header('Location: /admin/ponentes');
            }

            if(!empty($ponente->imagen)){
                $carpeta_imagenes = '../public/img/speakers';

                // Eliminar la imagen previa
          unlink($carpeta_imagenes . '/' . $ponente->imagen . ".png" );
          unlink($carpeta_imagenes . '/' . $ponente->imagen . ".webp" );
            }
           
            $resultado = $ponente->eliminar();

            if($resultado){
                header('Location: /admin/ponentes');
            }
           
        }
    }
}