<?php

namespace WavesInterpreter\Wave\Proxy;


use WavesInterpreter\Exception\WaveException;
use WavesInterpreter\Point\Point;
use WavesInterpreter\Wave\AbstractWave;

/**
 * Class ProxyWave
 * @package WavesInterpreter\Wave\Proxy
 */
class ProxyWave extends AbstractWave{

    /** @var AbstractWave  */
    private $wave;

    public function __construct(AbstractWave $wave)
    {
        $this->wave = $wave;
    }

    /**
     * @param Point $point
     * @throws \WavesInterpreter\Exception\WaveException
     */
    function addPoint(Point $point)
    {
        throw new WaveException("La onda está compuesta, no se pueden añadir más puntos");
    }

    /**
     * @return mixed
     */
    public function getTrail()
    {
        return $this->wave->getTrail();
    }

    /**
     * @return array
     */
    public function getCrest()
    {
        return $this->wave->getCrest();
    }

    /**
     * @return array
     */
    public function getTrough()
    {
        return $this->wave->getTrough();
    }

    /**
     * @return bool
     */
    public function isSinusoidal()
    {
        return $this->wave->isSinusoidal();
    }


    /**
     * @return Point
     */
    function getFirstPoint()
    {
        return $this->wave->getFirstPoint();
    }

    /**
     * @return Point
     */
    function getLastPoint()
    {
        return $this->wave->getLastPoint();

    }

    /**
     * @return Point
     */
    public function getMinPoint()
    {
        return $this->wave->getMinPoint();
    }


    /**
     * @return Point
     */
    public function getMaxPoint()
    {
        return $this->wave->getMaxPoint();
    }

}