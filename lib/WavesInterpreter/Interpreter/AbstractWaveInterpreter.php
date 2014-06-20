<?php


namespace WavesInterpreter\Interpreter;
use WavesInterpreter\Factory\Wave\SimpleWaveFactory;
use WavesInterpreter\Factory\WaveInterpreter\HashMapWaveFactory;
use WavesInterpreter\Wave\AbstractWave;

/**
 * Class AbstractWaveInterpreter
 * @package WavesInterpreter\Interpreter
 */
abstract class AbstractWaveInterpreter {

    /** @var  AbstractWave */
    protected  $wave;

    public function __construct($type = 'Simple')
    {
        $this->wave =($type == 'Simple') ?
            SimpleWaveFactory::getInstance()->createWave()
            :
            HashMapWaveFactory::getInstance()->createWave();
    }

    abstract function interpret($resource);

} 