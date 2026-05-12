<?php


 function autoload_9ddc7575c8692abe54985c7ec59c4d70($class)
{
    $classes = array(
        'Clases\Clases1\ClasesOperacionesExamen6Service' => __DIR__ .'/ClasesOperacionesExamen6Service.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_9ddc7575c8692abe54985c7ec59c4d70');

// Do nothing. The rest is just leftovers from the code generation.
{
}
