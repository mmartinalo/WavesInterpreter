<?php

namespace WavesInterpreter\Factory\WaveInterpreter;

use WavesInterpreter\Factory\WaveAbstractFactory;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\HashMap\HashMapWave;


/**
 * Class HashMapWaveFactory
 * @package WavesInterpreter\Factory\WaveInterpreter
 */
class HashMapWaveFactory extends WaveAbstractFactory{

    /** @var HashMapWaveFactory  */
    private static $instance = null;

    private function __construct(){}

    private function __clone(){}


    public static function getInstance()
    {
        if(is_null(self::$instance)){
            $gdWaveClass = __CLASS__;
            self::$instance = new $gdWaveClass;
        }

        return self::$instance;
    }

    /**
     * @return AbstractWave
     */
    function createWave()
    {
        return new HashMapWave();
    }
}