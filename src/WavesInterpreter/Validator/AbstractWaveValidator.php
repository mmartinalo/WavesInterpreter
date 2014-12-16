<?php

namespace WavesInterpreter\Validator;


use WavesInterpreter\Wave\AbstractWave;

/**
 * Class AbstractWaveValidator
 * @package WavesInterpreter\Validator
 */
abstract class AbstractWaveValidator {

    /** @var int Número mñaximo de pixeles que  admitimos como error de continuidad*/
    protected $maxContinuedError= 3;

    /** @var int Número de puntos mínimos que obligamos a tener para considerarlo una onda */
    protected $minLength = 10;

    /**
     * @param AbstractWave $wave
     * @return bool
     */
    abstract function validate(AbstractWave $wave);

    /**
     * @param int $maxContinuedError
     */
    public function setMaxContinuedError($maxContinuedError)
    {
        //No dejamos que lo establezcan 0 o negativo
        if($maxContinuedError < 1){
            return;
        }
        $this->maxContinuedError = $maxContinuedError;
    }

    /**
     * @return int
     */
    public function getMaxContinuedError()
    {
        return $this->maxContinuedError;
    }

    /**
     * @param int $minLength
     */
    public function setMinLength($minLength)
    {
        //No dejamos que lo establezcan 0 o negativo
        if($minLength < 1){
            return;
        }

        $this->minLength = $minLength;
    }

    /**
     * @return int
     */
    public function getMinLength()
    {
        return $this->minLength;
    }




} 