<?php

require __DIR__ . '/../vendor/autoload.php';

use Wsdl2PhpGenerator\Generator;
use Wsdl2PhpGenerator\Config;

// URL del WSDL
$wsdl = __DIR__ . '/../servidorSoap/servicio.wsdl';

// Carpeta donde se generarán las clases cliente
$outputDir = __DIR__ . '/../src/Clases/Clases1';

$generator = new Generator();

$config = new Config([
    'inputFile'  => $wsdl,
    'outputDir'  => $outputDir,
    'namespaceName' => 'Clases\\Clases1',
]);

$generator->generate($config);

echo "Clases cliente generadas correctamente.\n";
