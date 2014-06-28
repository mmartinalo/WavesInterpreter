<?php


namespace WavesInterpreter\Factory;

use WavesInterpreter\Wave\AbstractWave;

/**
 * Class WaveFactory
 * @package WavesInterpreter\Factory
 */
abstract class WaveFactory{

    /**
     * @param PointCollectionFactory $collection_factory
     * @return AbstractWave
     */
    abstract function createWave(PointCollectionFactory $collection_factory = null);

}