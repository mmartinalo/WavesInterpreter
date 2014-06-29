<?php


namespace WavesInterpreter\Validator\Simple;


use WavesInterpreter\Exception\WaveValidatorException;
use WavesInterpreter\Validator\AbstractWaveValidator;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Type\SimpleWave;

/**
 * Class ComplexWaveValidator
 * @package WavesInterpreter\Validator\Simple
 */
class SimpleWaveValidator extends AbstractWaveValidator{

    /**
     * @param AbstractWave $wave
     * @throws \WavesInterpreter\Exception\WaveValidatorException
     * @return bool
     */
    function validate(AbstractWave $wave)
    {
        if(!$wave instanceof SimpleWave){
            throw new WaveValidatorException('Me está llegando una onda de la clase: '.get_class($wave));
        }

        //todo Implementar

        return true;
    }
}