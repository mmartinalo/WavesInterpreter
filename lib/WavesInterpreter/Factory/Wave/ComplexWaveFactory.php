<?php

namespace WavesInterpreter\Factory\Wave;

use WavesInterpreter\Factory\PointCollection\SimpleCollectionFactory;
use WavesInterpreter\Factory\PointCollectionFactory;
use WavesInterpreter\Factory\WaveFactory;
use WavesInterpreter\Validator\AbstractWaveValidator;
use WavesInterpreter\Validator\Complex\ComplexWaveValidator;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Type\ComplexWave;


/**
 * Class HashMapWaveFactory
 * @package WavesInterpreter\Factory\WaveInterpreter
 */
class ComplexWaveFactory extends WaveFactory{

    /** @var ComplexWaveFactory  */
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
     * @return AbstractWave
     */
    function createWave(PointCollectionFactory $collection_factory = null)
    {
        if(!$collection_factory){
            $collection_factory = SimpleCollectionFactory::getInstance();
        }

        return new ComplexWave($collection_factory->createCollection());
    }

    /**
     * @return ComplexWaveValidator
     */
    function createValidator()
    {
        return new ComplexWaveValidator();
    }
}