<?php

namespace WavesInterpreter\Point\PointCollection\SimplePointCollection;

use WavesInterpreter\Point\Point;
use WavesInterpreter\Point\PointCollection\AbstractPointCollection;

/**
 * Class SimplePointCollection
 * @package WavesInterpreter\PointCollection\SimplePointCollection
 */
class SimplePointCollection extends AbstractPointCollection{

    public function __construct()
    {
        $this->collection = array();
        $this->position = 0;
    }

    function addPoint(Point $point)
    {
        $this->collection[] = $point;
    }

    function clear()
    {
        $this->collection = array();
    }

    function getFirst()
    {
        if(!count($this->collection)){
            return null;
        }

        return $this->collection[0];
    }

    function getLast()
    {
       return end($this->collection);
    }

    function count()
    {
        return count($this->collection);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->collection[$this->position];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset($this->collection[$this->position]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->position = 0;
    }

    function toArray()
    {
        return $this->collection;
    }
}