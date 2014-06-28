<?php

namespace WavesInterpreter\Wave\Point\PointCollection;
use WavesInterpreter\Wave\Point\Point;

/**
 * Class AbstractPointCollection
 * @package WavesInterpreter\Wave\PointCollection
 */
abstract class AbstractPointCollection implements \Iterator{

    protected $collection;

    protected $position;

    abstract function addPoint(Point $point);

    abstract function clear();

    abstract function getFirst();

    abstract function getLast();

    abstract function count();


}