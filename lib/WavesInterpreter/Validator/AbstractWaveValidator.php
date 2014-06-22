<?php

namespace WavesInterpreter\Validator;


use WavesInterpreter\Wave\AbstractWave;

/**
 * Class AbstractWaveValidator
 * @package WavesInterpreter\Validator
 */
abstract class AbstractWaveValidator {

    /**
     * @param AbstractWave $wave
     * @return true
     */
    abstract function validate(AbstractWave $wave);
} 