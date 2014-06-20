<?php


namespace WavesInterpreter\Factory;

use WavesInterpreter\Interpreter\AbstractWaveInterpreter;

/**
 * Class WaveInterpreterAbstractFactory
 * @package WavesInterpreter\Factory
 */
abstract class WaveInterpreterAbstractFactory{

    /**
     * @param string $waveType
     * @return AbstractWaveInterpreter
     */
    abstract function createWaveInterpreter($waveType = 'Simple');


}