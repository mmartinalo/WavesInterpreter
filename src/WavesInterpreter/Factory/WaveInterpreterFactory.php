<?php


namespace WavesInterpreter\Factory;

use WavesInterpreter\Interpreter\AbstractWaveInterpreter;

/**
 * Class WaveInterpreterFactory
 * @package WavesInterpreter\Factory
 */
abstract class WaveInterpreterFactory{

    /**
     * @param WaveFactory $waveFactory
     * @internal param string $waveType
     * @return AbstractWaveInterpreter
     */
    abstract function createWaveInterpreter(WaveFactory $waveFactory = null);


}