<?php
error_reporting(E_ALL & ~E_DEPRECATED);

session_start();
require '../vendor/autoload.php';

use Clases\Clases1\ClasesOperacionesExamen6Service;
use Clases\Jugadores;
use Milon\Barcode\DNS1D;
use Philo\Blade\Blade;

$views = '../views';
$cache = '../cache';
$blade = new Blade($views, $cache);

$d          = new DNS1D();
$titulo     = 'Jugadores';
$encabezado = 'Listado de Jugadores';
$jugadores  = (new Jugadores())->recuperarJugadores();

$d->setStorPath($cache);
$listaPosicion = null;
$posSeleccionada = null;

if (isset($_GET['pos'])) {
    $posSeleccionada = $_GET['pos'];

    // Cliente SOAP generado
    $wsdl = 'http://localhost/examen06/servidorSoap/servicio.wsdl';
    $clienteSoap = new ClasesOperacionesExamen6Service([], $wsdl);

    // Llamamos a getPosicion del servicio
    $listaPosicion = $clienteSoap->getPosicion($posSeleccionada);
}

// Mensaje de sesión (si lo hay)
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']); 
    echo $blade
        ->view()
        ->make(
            'vjugadores',
            compact(
                'titulo',
                'encabezado',
                'jugadores',
                'd',
                'mensaje',
                'listaPosicion',
                'posSeleccionada'
            )
        )
        ->render();
} else {
    echo $blade
        ->view()
        ->make(
            'vjugadores',
            compact(
                'titulo',
                'encabezado',
                'jugadores',
                'd',
                'listaPosicion',
                'posSeleccionada'
            )
        )
        ->render();
}