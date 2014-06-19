<?php

namespace WavesInterpreter\Creator\HashMap;

use WavesInterpreter\Creator\AbstractCreator;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;
use WavesInterpreter\Interpreter\HashMap\HashMapWaveInterpreter;

/**
 * Class HashMapWaveInterpreterCreator
 * @package WavesInterpreter\Creator\HashMap
 */
class HashMapWaveInterpreterCreator extends AbstractCreator{


    /**
     * @return AbstractWaveInterpreter
     */
    function createInterpreter()
    {
        return new HashMapWaveInterpreter($this->resource);
    }
}