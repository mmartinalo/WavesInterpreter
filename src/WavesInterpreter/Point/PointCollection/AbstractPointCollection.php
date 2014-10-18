<?php

namespace WavesInterpreter\Point\PointCollection;
use WavesInterpreter\Point\Point;

/**
 * Class AbstractPointCollection
 * @package WavesInterpreter\PointCollection
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