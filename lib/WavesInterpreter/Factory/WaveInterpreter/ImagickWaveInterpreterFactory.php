<?php

namespace WavesInterpreter\Factory\WaveInterpreter;

use WavesInterpreter\Factory\Wave\ComplexWaveFactory;
use WavesInterpreter\Factory\WaveFactory;
use WavesInterpreter\Factory\WaveInterpreterFactory;
use WavesInterpreter\Interpreter\Imagick\ImagickWaveInterpreter;


/**
 * Class ImagickWaveInterpreterFactory
 * @package WavesInterpreter\Factory\WaveInterpreter
 */
class ImagickWaveInterpreterFactory extends WaveInterpreterFactory{

    /** @var ImagickWaveInterpreterFactory  */
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
     * @return ImagickWaveInterpreter
     */
    function createWaveInterpreter(WaveFactory $waveFactory= null)
    {
        if(!$waveFactory){
            $waveFactory = ComplexWaveFactory::getInstance();
        }

        return new ImagickWaveInterpreter($waveFactory);
    }
}