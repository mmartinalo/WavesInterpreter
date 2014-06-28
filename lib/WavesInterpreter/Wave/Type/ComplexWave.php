<?php

namespace WavesInterpreter\Wave\Type;

use WavesInterpreter\Wave\Point\Point;
use WavesInterpreter\Wave\AbstractWave;


/**
 * Class ComplexWave
 * @package WavesInterpreter\Wave\Type
 */
class ComplexWave extends AbstractWave{


    /** @var array[Point] */
    protected $crest = null;

    /** @var array[Point] */
    protected $trough = null;

    /** @var bool  */
    protected $is_sinusoidal = false;

    /** @var  int */
    protected $frequency = 0;

    /** @var Point  */
    protected $max_point = null;

    /** @var Point  */
    protected $min_point = null;


    /**
     * @param Point $point
     */
    public function addPoint(Point $point)
    {

        //Lo añadimos al recorrido
        $this->trail->addPoint($point);
        //Actualizamos el máximo y mínimo de la onda
        //todo esto queremos hacerlo cada vez que insertemos o lo generamos en el getter?
        $this->updateMaxAndMin($point);

        //todo lo de las crestas y valles

        //todo es sinusoidal?
    }



    /**
     * @return array[Point]
     */
    public function getCrest()
    {
        return $this->crest;
    }

    /**
     * @return array[Point]
     */
    public function getTrough()
    {
        return $this->trough;
    }



    /**
     * @return bool
     */
    public function isSinusoidal()
    {
        return $this->is_sinusoidal;
    }

    /**
     * @return Point
     */
    public function getMaxPoint()
    {
        return $this->max_point;
    }

    /**
     * @return Point
     */
    public function getMinPoint()
    {
        return $this->min_point;
    }

    /**
     * @param Point $point
     * @return bool
     */
    protected function updateMaxAndMin(Point $point)
    {
        return $this->updateMax($point) || $this->updateMin($point);
    }
    /**
     * @param Point $point
     * @return bool
     */
    protected function updateMax(Point $point)
    {
        if(is_null($this->max_point)){
            $this->max_point = $point;
            return true;
        }

        if($this->max_point->getX() < $point->getX()){
            $this->max_point = $point;
            return true;
        }

        return false;
    }

    /**
     * @param Point $point
     * @return bool
     */
    protected function updateMin(Point $point)
    {
        if(is_null($this->min_point)){
            $this->min_point = $point;
            return true;
        }

        if($this->min_point->getX() > $point->getX()){
            $this->min_point = $point;
            return true;
        }

        return false;
    }

    /**
     * @param Point $point
     */
    protected function addCrest(Point $point)
    {
        $this->crest[] = $point;
    }

    /**
     * @param Point $point
     */
    protected  function addTrough(Point $point)
    {
        $this->trough[] = $point;
    }


}