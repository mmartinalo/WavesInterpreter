<?php

namespace WavesInterpreter\Factory\WaveInterpreter;

use WavesInterpreter\Factory\WaveFactory;
use WavesInterpreter\Factory\Wave\ComplexWaveFactory;
use WavesInterpreter\Factory\WaveInterpreterFactory;
use WavesInterpreter\Interpreter\Gd\GdWaveInterpreter;


/**
 * Class GdWaveInterpreterFactory
 * @package WavesInterpreter\Factory\WaveInterpreter
 */
class GdWaveInterpreterFactory extends WaveInterpreterFactory{

    /** @var GdWaveInterpreterFactory  */
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
     * @param WaveFactory $waveFactory
     * @return GdWaveInterpreter
     */
    function createWaveInterpreter(WaveFactory $waveFactory = null)
    {
        if(!$waveFactory){
            $waveFactory = ComplexWaveFactory::getInstance();
        }

        return new GdWaveInterpreter($waveFactory);
    }
}