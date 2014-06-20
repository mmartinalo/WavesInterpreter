<?php


namespace WavesInterpreter\Factory;

use WavesInterpreter\Interpreter\AbstractWaveInterpreter;

/**
 * Class WaveAbstractFactory
 * @package WavesInterpreter\Factory
 */
abstract class WaveAbstractFactory{

    /**
     * @return AbstractWaveInterpreter
     */
    abstract function createWave();


}