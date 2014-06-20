<?php

namespace WavesInterpreter\Wave\HashMap;

use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Point;

/**
 * Class HashMapWave
 * @package WavesInterpreter\Wave\HashMap
 */
class HashMapWave extends AbstractWave{

    /** @var int  */
    protected $step;

    public function __construct()
    {
        $this->trail = array();
        $this->step = 0;
    }


    /**
     * @param Point $point
     */
    public function addPoint(Point $point)
    {
        $this->trail[$point->getX()][$point->getY()] = ++$this->step;

        $this->updateMaxAndMin($point);
    }

}