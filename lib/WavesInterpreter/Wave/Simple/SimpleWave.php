<?php

namespace WavesInterpreter\Wave\Simple;

use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Point;


/**
 * Class SimpleWave
 * @package WavesInterpreter\Wave\Simple
 */
class SimpleWave extends AbstractWave{


    public function __construct()
    {
        $this->trail = array();
    }


    /**
     * @param Point $point
     */
    public function addPoint(Point $point)
    {
        $this->trail[] = $point;
    }

}