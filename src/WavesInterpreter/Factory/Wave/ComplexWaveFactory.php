<?php

namespace WavesInterpreter\Factory\Wave;

use WavesInterpreter\Factory\PointCollection\SimpleCollectionFactory;
use WavesInterpreter\Factory\PointCollectionFactory;
use WavesInterpreter\Factory\WaveFactory;
use WavesInterpreter\Validator\Complex\ComplexWaveValidator;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Complex\ComplexWave;


/**
 * Factoria abstracta para la creación de ondas y elementos de la familia ComplexWave
 *
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
     * En caso de que no reciba por parámetro un PointCollectionFactory
     * por defecto creará una la colección de elementos de la onda del a través
     * de SimpleCollectionFactory
     *
     * @param PointCollectionFactory $collectionFactory
     * @return AbstractWave
     */
    function createWave(PointCollectionFactory $collectionFactory = null)
    {
        if(!$collectionFactory){
            $collectionFactory = SimpleCollectionFactory::getInstance();
        }

        return new ComplexWave($collectionFactory->createCollection());
    }

    /**
     * @return ComplexWaveValidator
     */
    function createValidator()
    {
        return new ComplexWaveValidator();
    }
}