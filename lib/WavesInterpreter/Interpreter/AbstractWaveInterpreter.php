<?php


namespace WavesInterpreter\Interpreter;
use WavesInterpreter\Wave\AbstractWave;

/**
 * Class AbstractWaveInterpreter
 * @package WavesInterpreter\Interpreter
 */
abstract class AbstractWaveInterpreter {

    /** @var  AbstractWave */
    protected  $wave;

    abstract function __construct($resource);

    abstract function getMax();

    abstract function getMin();

} 