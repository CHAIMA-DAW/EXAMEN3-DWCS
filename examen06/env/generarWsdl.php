<?php

require __DIR__ . '/../vendor/autoload.php';

use PHP2WSDL\PHPClass2WSDL;

$class = 'Clases\OperacionesExamen6';

$uri = 'http://localhost/examen06/servidorSoap/servicio.php';

if (!class_exists($class)) {
    die("Error: la clase $class no se pudo cargar. Revisa namespaces y composer dump-autoload.");
}

$wsdlGenerator = new PHPClass2WSDL($class, $uri);
$wsdlGenerator->generateWSDL(true);

$wsdlGenerator->save(__DIR__ . '/../servidorSoap/servicio.wsdl');

echo "WSDL generado correctamente.\n";

