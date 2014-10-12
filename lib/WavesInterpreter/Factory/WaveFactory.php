<?php


namespace WavesInterpreter\Factory;

use WavesInterpreter\Validator\AbstractWaveValidator;
use WavesInterpreter\Wave\AbstractWave;

/**
 * Class WaveFactory
 * @package WavesInterpreter\Factory
 */
abstract class WaveFactory{

    /**
     * @param PointCollectionFactory $collectionFactory
     * @return AbstractWave
     */
    abstract function createWave(PointCollectionFactory $collectionFactory = null);

    /**
     * @return AbstractWaveValidator
     */
    abstract function createValidator();

}