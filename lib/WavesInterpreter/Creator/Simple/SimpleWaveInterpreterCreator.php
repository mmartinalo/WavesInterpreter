<?php

namespace WavesInterpreter\Factory\HashMap;

use WavesInterpreter\Creator\AbstractCreator;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;
use WavesInterpreter\Interpreter\Simple\SimpleWaveInterpreter;

/**
 * Class SimpleWaveInterpreterCreator
 * @package WavesInterpreter\Factory\HashMap
 */
class SimpleWaveInterpreterCreator extends AbstractCreator{


    /**
     * @return AbstractWaveInterpreter
     */
    function createInterpreter()
    {
        return new SimpleWaveInterpreter($this->resource);
    }
}