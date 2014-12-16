<?php

namespace WavesInterpreter\Factory\Wave;

use WavesInterpreter\Factory\PointCollection\SimpleCollectionFactory;
use WavesInterpreter\Factory\PointCollectionFactory;
use WavesInterpreter\Factory\WaveFactory;
use WavesInterpreter\Validator\Simple\SimpleWaveValidator;
use WavesInterpreter\Wave\Simple\SimpleWave;


/**
 * Factoria abstracta para crear instancias de la familia de ondas simples
 *
 * Class SimpleWaveFactory
 * @package WavesInterpreter\Factory\WaveInterpreter
 */
class SimpleWaveFactory extends WaveFactory{

    /** @var SimpleWaveFactory  */
    private static $instance = null;

    private function __construct(){}


    public static function getInstance()
    {
        if(is_null(self::$instance)){
            $gdWaveClass = __CLASS__;
            self::$instance = new $gdWaveClass;
        }

        return self::$instance;
    }

    public function __clone(){
        throw new \Exception("Operación no permitida");
    }

    /**
     * En caso de que no se le pase un PointCollectionFactory como parámetro
     * crearña las colecciones a través de la factoria SimpleCollectionFactory
     *
     * @param PointCollectionFactory $collectionFactory
     * @return SimpleWaveFactory
     */
    function createWave(PointCollectionFactory $collectionFactory= null)
    {
        if(!$collectionFactory){
            $collectionFactory = SimpleCollectionFactory::getInstance();
        }

        return new SimpleWave($collectionFactory->createCollection());
    }

    /**
     * @return SimpleWaveValidator
     */
    function createValidator()
    {
        return new SimpleWaveValidator();
    }
}