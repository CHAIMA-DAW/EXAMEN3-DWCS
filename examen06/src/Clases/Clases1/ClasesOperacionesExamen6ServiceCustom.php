<?php

namespace Clases\Clases1;

class ClasesOperacionesExamen6ServiceCustom extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
);

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null)
    {
    
  foreach (self::$classmap as $key => $value) {
    if (!isset($options['classmap'][$key])) {
      $options['classmap'][$key] = $value;
    }
  }
      $options = array_merge(array (
  'features' => 1,
), $options);
      if (!$wsdl) {
        $wsdl = 'H:\Mi unidad\2025-2026\06-MP613-DWCS\00-AVALIACION\AVALIACION-03\EXAMENES\RECUPERACIONES\GITHUB\Chaima Nichami\EXAMEN3-DWCS\examen06\env/../servidorSoap/servicio.wsdl';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * Devuelve un array con los nombres completos de los jugadores

que tienen la posición indicada (Portero, Defensa, ...).
     *
     * @param string $posicion
     * @return Array
     */
    public function getPosicion($posicion)
    {
      return $this->__soapCall('getPosicion', array($posicion));
    }

}
