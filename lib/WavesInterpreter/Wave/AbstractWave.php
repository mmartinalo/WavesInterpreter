<?php

namespace WavesInterpreter\Wave;

/**
 * Class AbstractWave
 * @package WavesInterpreter\Wave
 */
abstract class AbstractWave {

    protected $trail;

    function getTrail()
    {
        return $this->trail;
    }

    abstract function addPoint(Point $point);
} 