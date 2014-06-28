<?php

namespace WavesInterpreter\Wave\Type;

use WavesInterpreter\Exception\WaveException;
use WavesInterpreter\Wave\Point\Point;

use WavesInterpreter\Wave\AbstractWave;


/**
 * Class SimpleWave
 * @package WavesInterpreter\Wave\Type
 */
class SimpleWave extends AbstractWave{


    /**
     * @param Point $point
     */
    public function addPoint(Point $point)
    {
        //Lo añadimos al recorrido
        $this->trail->addPoint($point);
    }

    /**
     * @throws \WavesInterpreter\Exception\WaveException
     * @return array[Point]
     */
    public function getCrest()
    {
        throw new WaveException("La clase SimpleWave no dispone de este método");
    }

    /**
     * @throws \WavesInterpreter\Exception\WaveException
     * @return array[Point]
     */
    public function getTrough()
    {
        throw new WaveException("La clase SimpleWave no dispone de este método");
    }


    /**
     * @throws \WavesInterpreter\Exception\WaveException
     * @return bool
     */
    public function isSinusoidal()
    {
        throw new WaveException("La clase SimpleWave no dispone de este método");
    }

    /**
     * @throws \WavesInterpreter\Exception\WaveException
     * @return Point
     */
    public function getMaxPoint()
    {
        throw new WaveException("La clase SimpleWave no dispone de este método");
    }

    /**
     * @throws \WavesInterpreter\Exception\WaveException
     * @return Point
     */
    public function getMinPoint()
    {
        throw new WaveException("La clase SimpleWave no dispone de este método");
    }



}