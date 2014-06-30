<?php

namespace WavesInterpreter\Validator;


use WavesInterpreter\Wave\AbstractWave;

/**
 * Class AbstractWaveValidator
 * @package WavesInterpreter\Validator
 */
abstract class AbstractWaveValidator {

    /** @var int Número mñaximo de pixeles que  admitimos como error de continuidad*/
    protected $max_continued_error= 3;

    /** @var int Número de puntos mínimos que obligamos a tener para considerarlo una onda */
    protected $min_length = 10;

    /**
     * @param AbstractWave $wave
     * @return bool
     */
    abstract function validate(AbstractWave $wave);

    /**
     * @param int $max_continued_error
     */
    public function setMaxContinuedError($max_continued_error)
    {
        //No dejamos que lo establezcan 0 o negativo
        if($max_continued_error < 1){
            return;
        }
        $this->max_continued_error = $max_continued_error;
    }

    /**
     * @return int
     */
    public function getMaxContinuedError()
    {
        return $this->max_continued_error;
    }

    /**
     * @param int $min_length
     */
    public function setMinLength($min_length)
    {
        //No dejamos que lo establezcan 0 o negativo
        if($min_length < 1){
            return;
        }

        $this->min_length = $min_length;
    }

    /**
     * @return int
     */
    public function getMinLength()
    {
        return $this->min_length;
    }




} 