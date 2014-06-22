<?php

namespace WavesInterpreter\Wave\Proxy;


use WavesInterpreter\Exception\WaveException;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Point;

/**
 * Class ProxyWave
 * @package WavesInterpreter\Wave\Proxy
 */
class ProxyWave extends AbstractWave{

    /** @var \WavesInterpreter\Wave\AbstractWave  */
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
     * @param Point $point
     * @throws \WavesInterpreter\Exception\WaveException
     */
    public function addCrest(Point $point)
    {
        throw new WaveException("La onda está compuesta, no se pueden añadir más crestas");
    }

    /**
     * @param Point $point
     * @throws \WavesInterpreter\Exception\WaveException
     */
    public function addTrough(Point $point)
    {
        throw new WaveException("La onda está compuesta, no se pueden añadir más valles");
    }

    /**
     * @param bool $bool
     * @throws \WavesInterpreter\Exception\WaveException
     */
    public function setSinusoidal($bool = true)
    {
        throw new WaveException();
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
        return $this->wave->getTrail();
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


}