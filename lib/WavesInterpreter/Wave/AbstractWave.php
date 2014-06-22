<?php

namespace WavesInterpreter\Wave;

/**
 * + Cresta [Crest]: La cresta es el punto de máxima elongación o máxima amplitud de la onda; es decir, el punto de la onda más separado de su posición de reposo.
 * + Período o Longitud de onda [Period] (T): El periodo es el tiempo que tarda la onda en ir de un punto de máxima amplitud al siguiente.
 * + Amplitud [Wavelength] (A): La amplitud es la distancia vertical entre una cresta y el punto medio de la onda. Nótese que pueden existir ondas cuya amplitud sea variable, es decir, crezca o decrezca con el paso del tiempo.
 * + Frecuencia [Frequency] (f): Número de veces que es repetida dicha vibración por unidad de tiempo. En otras palabras, es una simple repetición de valores por un período determinado. T = \frac{1}{f}
 * + Valle [Trough]: Es el punto más bajo de una onda.
 * + Nodo: es el punto donde la onda cruza la línea de equilibrio.
 * + Elongación (x): es la distancia que hay, en forma perpendicular, entre un punto de la onda y la línea de equilibrio.
 * + Ciclo [Wavelength]: es una oscilación, o viaje completo de ida y vuelta.
 * + Velocidad de propagación (v): es la velocidad a la que se propaga el movimiento ondulatorio. Su valor es el cociente de la longitud de onda y su período.v = \frac{\lambda}{T}
 *
 * Class AbstractWave
 * @package WavesInterpreter\Wave
 */
abstract class AbstractWave {

    protected $trail;

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

    abstract function addPoint(Point $point);

    public function getTrail()
    {
        return $this->trail;
    }

    public function getCrest()
    {
        return $this->crest;
    }

    public function getTrough()
    {
        return $this->trough;
    }

    public function addCrest(Point $point)
    {
        $this->crest[] = $point;
    }

    public function addTrough(Point $point)
    {
        $this->trough[] = $point;
    }

    public function isSinusoidal()
    {
        return $this->is_sinusoidal;
    }

    public function setSinusoidal($bool = true)
    {
        $this->is_sinusoidal = $bool;
    }

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

} 