<?php

namespace WavesInterpreter\Factory\Wave;

use WavesInterpreter\Factory\WaveAbstractFactory;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Simple\SimpleWave;


/**
 * Class GdWaveInterpreterFactory
 * @package WavesInterpreter\Factory\Gd
 */
class SimpleWaveFactory extends WaveAbstractFactory{

    /** @var SimpleWaveFactory  */
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
        return new SimpleWave();
    }
}