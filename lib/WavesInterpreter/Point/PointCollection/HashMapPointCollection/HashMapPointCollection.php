<?php

namespace WavesInterpreter\Point\PointCollection\HashMapPointCollection;

use WavesInterpreter\Point\Point;
use WavesInterpreter\Point\PointCollection\AbstractPointCollection;

/**
 * Class HashMapPointCollection
 * @package WavesInterpreter\PointCollection\HashMapPointCollection
 */
class HashMapPointCollection extends AbstractPointCollection{

    /** @var int variable que guardará el orden del recorrido a la hora de insertar */
    protected $step;

    public function __construct()
    {
        $this->step = 0;
        $this->collection = array();
        $this->position = 0;
    }

    function addPoint(Point $point)
    {
        //Guardamos el step en el array y luego incrementamos
        $this->collection[$point->getX()][$point->getY()] = $this->step++;
    }

    function clear()
    {
        $this->step = 0;
        $this->collection = array();
    }

    function getFirst()
    {
        if(!$this->step){
            return null;
        }

        $x = array_keys($this->collection)[0];
        $y = array_search(0,$this->collection[$x]);

        return new Point($x,$y);
    }

    function getLast()
    {
        if(!$this->step){
            return null;
        }

        $keys = array_keys($this->collection);
        $x = end($keys);
        $y = array_search(0,$this->collection[$x]);
        return new Point($x,$y);
    }

    function count()
    {
        return $this->step;
    }


    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {

        foreach($this->collection as $x => $values) {
            if($y = array_search($this->position,$values)){
                //Si entra siempre saldrá por aquí ya que es lo mismo que el método valid()
                return new Point($x,$y);
            }
        }

        return null;
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
        $is_valid = false;

        foreach($this->collection as $x => $values) {
            if(array_search($this->position,$values)){
                $is_valid = true;
            }
        }

        return $is_valid;
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


}