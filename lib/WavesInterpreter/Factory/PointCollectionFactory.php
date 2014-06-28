<?php


namespace WavesInterpreter\Factory;

use WavesInterpreter\Wave\Point\PointCollection\AbstractPointCollection;

/**
 * Class PointCollectionFactory
 * @package WavesInterpreter\Factory
 */
abstract class PointCollectionFactory{

    /**
     * @return AbstractPointCollection
     */
    abstract function createCollection();



}