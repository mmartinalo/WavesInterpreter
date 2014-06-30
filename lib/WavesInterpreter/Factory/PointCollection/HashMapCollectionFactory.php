<?php

namespace WavesInterpreter\Factory\PointCollection;


use WavesInterpreter\Factory\PointCollectionFactory;
use WavesInterpreter\Point\PointCollection\HashMapPointCollection\HashMapPointCollection;

/**
 * Class HashMapCollectionFactory
 * @package WavesInterpreter\Factory\WaveInterpreter
 */
class HashMapCollectionFactory extends PointCollectionFactory{

    /** @var HashMapCollectionFactory  */
    private static $instance = null;

    private function __construct(){}

    public function __clone(){
        throw new \Exception("Operación no permitida");
    }


    public static function getInstance()
    {
        if(is_null(self::$instance)){
            $gdWaveClass = __CLASS__;
            self::$instance = new $gdWaveClass;
        }

        return self::$instance;
    }


    /**
     * @return HashMapPointCollection
     */
    function createCollection()
    {
        return new HashMapPointCollection();
    }
}