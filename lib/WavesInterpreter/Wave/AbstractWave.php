<?php

namespace WavesInterpreter\Wave;

use WavesInterpreter\Point\Point;
use WavesInterpreter\Point\PointCollection\AbstractPointCollection;

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

    /** @var  AbstractPointCollection */
    protected $trail;

    public function __construct(AbstractPointCollection $point_collection)
    {
        $point_collection->clear();
        $this->trail = $point_collection;
    }

    abstract function addPoint(Point $point);

    /**
     * @return array[Point]
     */
    abstract function getCrest();

    /**
     * @return array[Point]
     */
    abstract function getTrough();

    /**
     * @return bool
     */
    abstract function isSinusoidal();

    /**
     * @return Point
     */
    abstract function getMaxPoint();

    /**
     * @return Point
     */
    abstract function getMinPoint();

    /**
     * @return AbstractPointCollection
     */
    public function getTrail()
    {
        return $this->trail;
    }


    /**
     * @return Point
     */
    public function getFirstPoint()
    {
        return $this->trail->getFirst();
    }

    /**
     * @return Point
     */
    public function getLastPoint()
    {
        return $this->trail->getlast();
    }
} 