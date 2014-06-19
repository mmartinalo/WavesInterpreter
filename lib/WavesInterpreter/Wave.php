<?php
namespace WavesInterpreter;

/**
 * Class Wave
 * @package WavesInterpreter
 */
class Wave {

    /** @var  array[Point] */
    protected $trail;


    public function __construct()
    {
        $this->trail = array();
    }

    /**
     * @return array
     */
    public function getTrail()
    {
        return $this->trail;
    }

    /**
     * @param Point $point
     */
    public function addPoint(Point $point)
    {
        $this->trail[] = $point;
    }

} 