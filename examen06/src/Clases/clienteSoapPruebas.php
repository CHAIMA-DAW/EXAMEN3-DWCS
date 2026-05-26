<?php


error_reporting(E_ALL & ~E_DEPRECATED);

require __DIR__  . '/../../vendor/autoload.php';

use Clases\Clases1\ClasesOperacionesExamen6Service;

// URL del WSDL
$wsdl = 'http://corrige.localhost/examen06/servidorSoap/servicio.wsdl';

// Creamos el cliente generado a partir del WSDL
$cliente = new ClasesOperacionesExamen6Service([],$wsdl);


echo "Introduce una posición (Portero, Defensa, Lateral Izquierdo, Lateral Derecho, Central, Delantero): ";
// $posicion = trim(fgets(STDIN));
$posicion = "Portero"; // Para pruebas, puedes cambiar esta posición según lo que quieras probar

// Llamamos a la operación getPosicion del servicio
try {
$resultado = $cliente->getPosicion($posicion);

// Mostramos el resultado por consola
echo "\nJugadores en la posición '$posicion':\n" ;

if (is_array($resultado) && count($resultado) > 0) {
    foreach ($resultado as $jugador) {
        if (is_array($jugador) && isset($jugador['nombreCompleto'])) {
        echo " - " . $jugador['nombreCompleto'] . "\n";
    }

        else if(is_object($jugador) && isset($jugador->nombreCompleto ))  {
            echo " - " . $jugador['nombreCompleto'] . "\n";

    } else {
        echo " - " . $jugador . "\n";
    }
     }
}else {
    echo "No hay jugadores con esa posición." .  "\n";
}
}
catch (Exception $e){
    echo "error al llamar sevicio SOAP." . $e->getMessage() . "\n";
}

