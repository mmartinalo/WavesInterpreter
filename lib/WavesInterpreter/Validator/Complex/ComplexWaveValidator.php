<?php


namespace WavesInterpreter\Validator\Complex;


use WavesInterpreter\Exception\WaveValidatorException;
use WavesInterpreter\Validator\AbstractWaveValidator;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Type\ComplexWave;

/**
 * Class ComplexWaveValidator
 * @package WavesInterpreter\Validator\Complex
 */
class ComplexWaveValidator extends AbstractWaveValidator{

    /**
     * @param AbstractWave $wave
     * @throws \WavesInterpreter\Exception\WaveValidatorException
     * @return bool
     */
    function validate(AbstractWave $wave)
    {
        if(!$wave instanceof ComplexWave){
            throw new WaveValidatorException('Me está llegando una onda de la clase: '.get_class($wave));
        }

        //todo Implementar

        return true;
    }
}