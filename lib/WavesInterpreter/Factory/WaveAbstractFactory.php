<?php


namespace WavesInterpreter\Factory;

use WavesInterpreter\Interpreter\AbstractWaveInterpreter;
use WavesInterpreter\Validator\AbstractWaveValidator;

/**
 * Class WaveAbstractFactory
 * @package WavesInterpreter\Factory
 */
abstract class WaveAbstractFactory{

    /**
     * @return AbstractWaveInterpreter
     */
    abstract function createWave();


    /**
     * @return AbstractWaveValidator
     */
    abstract function createValidator();
}