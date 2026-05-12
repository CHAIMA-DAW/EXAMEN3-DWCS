<?php


require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Clases/OperacionesExamen6.php';

use Clases\OperacionesExamen6;

$wsdl = __DIR__  . '/servicio.wsdl';

try {
    
    $server = new SoapServer($wsdl);

    // Indicamos la clase que implementa las operaciones del servicio
    $server->setClass(OperacionesExamen6::class);

    
    $server->handle();
} catch (SoapFault $f) {

    error_log("Error SOAP: " . $f->getMessage());
}