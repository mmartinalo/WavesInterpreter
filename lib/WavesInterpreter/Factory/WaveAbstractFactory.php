<?php


namespace WavesInterpreter\Factory;

use WavesInterpreter\Validator\AbstractWaveValidator;
use WavesInterpreter\Wave\AbstractWave;

/**
 * Class WaveAbstractFactory
 * @package WavesInterpreter\Factory
 */
abstract class WaveAbstractFactory{

    /**
     * @return AbstractWave
     */
    abstract function createWave();


    /**
     * @return AbstractWaveValidator
     */
    abstract function createValidator();
}