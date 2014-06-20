<?php

namespace WavesInterpreter\Wave;

/**
 * Class AbstractWave
 * @package WavesInterpreter\Wave
 */
abstract class AbstractWave {

    protected $trail;

    /** @var Point  */
    protected $max__point = null;

    /** @var Point  */
    protected $min_point = null;

    public function getTrail()
    {
        return $this->trail;
    }

    public function getMaxPoint()
    {
        return $this->max__point;
    }

    public function getMinPoint()
    {
        return $this->min_point;
    }

    abstract function addPoint(Point $point);

    public function updateMaxAndMin(Point $point)
    {
        return $this->updateMax($point) || $this->updateMin($point);
    }

    /**
     * @param Point $point
     * @return bool
     */
    public function updateMax(Point $point)
    {
        if(is_null($this->max__point)){
            $this->max__point = $point;
            return true;
        }

        if($this->max__point->getX() < $point->getX()){
            $this->max__point = $point;
            return true;
        }

        return false;
    }

    /**
     * @param Point $point
     * @return bool
     */
    public function updateMin(Point $point)
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
} 