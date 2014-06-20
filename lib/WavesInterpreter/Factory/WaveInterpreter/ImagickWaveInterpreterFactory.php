<?php

namespace WavesInterpreter\Factory\WaveInterpreter;

use WavesInterpreter\Factory\WaveInterpreterAbstractFactory;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;
use WavesInterpreter\Interpreter\Imagick\ImagickWaveInterpreter;


/**
 * Class ImagickWaveInterpreterFactory
 * @package WavesInterpreter\Factory\WaveInterpreter
 */
class ImagickWaveInterpreterFactory extends WaveInterpreterAbstractFactory{

    /** @var ImagickWaveInterpreterFactory  */
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
     * @param string $waveType
     * @return AbstractWaveInterpreter
     */
    function createWaveInterpreter($waveType = 'Simple')
    {
        return new ImagickWaveInterpreter($waveType);
    }


}