<?php


 function autoload_f5a8b0088855078600278028ca3b45ac($class)
{
    $classes = array(
        'Clases\Clases1\ClasesOperacionesExamen6ServiceCustom' => __DIR__ .'/ClasesOperacionesExamen6ServiceCustom.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_f5a8b0088855078600278028ca3b45ac');

// Do nothing. The rest is just leftovers from the code generation.
{
}
