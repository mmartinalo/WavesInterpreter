<?php

namespace WavesInterpreter\Factory\Wave;

use WavesInterpreter\Factory\PointCollection\SimpleCollectionFactory;
use WavesInterpreter\Factory\PointCollectionFactory;
use WavesInterpreter\Factory\WaveFactory;
use WavesInterpreter\Validator\Simple\SimpleWaveValidator;
use WavesInterpreter\Wave\Simple\SimpleWave;


/**
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
     * @param PointCollectionFactory $collection_factory
     * @return SimpleWaveFactory
     */
    function createWave(PointCollectionFactory $collection_factory= null)
    {
        if(!$collection_factory){
            $collection_factory = SimpleCollectionFactory::getInstance();
        }

        return new SimpleWave($collection_factory->createCollection());
    }

    /**
     * @return SimpleWaveValidator
     */
    function createValidator()
    {
        return new SimpleWaveValidator();
    }
}