<?php

namespace WavesInterpreter;

use WavesInterpreter\Exception\WavePointException;

/**
 * Class Point
 * @package WavesInterpreter
 */
class Point {

    /** @var  int */
    protected $x;

    /** @var  int */
    protected $y;

    /**
     * @param $x
     * @param $y
     */
    public function __construct($x , $y)
    {
        $this->setX($x);
        $this->setY($y);
    }

    /**
     * @param int $x
     * @throws Exception\WavePointException
     * @return $this
     */
    public function setX($x)
    {

        if(!is_int($x)){
            throw new WavePointException("Error al setear la coordenada x, el valor pasado como parámetro no es un entero");
        }

        $this->x = $x;

        return $this;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $y
     * @throws Exception\WavePointException
     * @return $this
     */
    public function setY($y)
    {
        if(!is_int($y)){
            throw new WavePointException("Error al setear la coordenada y, el valor pasado como parámetro no es un entero");
        }

        $this->y = $y;

        return $this;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }




} 