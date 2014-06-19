<?php


namespace WavesInterpreter\Creator;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;

/**
 * Class AbstractCreator
 * @package WavesInterpreter\Creator
 */
abstract class AbstractCreator {

    /** @var  resource */
    protected $resource;

    public function __construct($resource)
    {
        //todo Cargar la imagen
        $this->resource = $resource;
    }
    /**
     * @return AbstractWaveInterpreter
     */
    abstract function createInterpreter();

}