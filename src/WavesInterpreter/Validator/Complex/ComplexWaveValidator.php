<?php


namespace WavesInterpreter\Validator\Complex;


use WavesInterpreter\Exception\WaveValidatorException;
use WavesInterpreter\Point\Point;
use WavesInterpreter\Validator\AbstractWaveValidator;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Complex\ComplexWave;

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

        //Si no llega a la longitud mínima establecida no lo validamos
        if($wave->getTrail()->count() < $this->getMinLength()){
            return false;
        }

        //Comprobamos tres puntos:
        // 1 - continuidad
        // 3 - en el eje x no puede haber dos puntos separados demasiado espacio

        /** @var Point $lastPoint */
        $lastPoint = null;
        //Lo usaremos para ver que no se repiten en el  mismo eje dos puntos
        $xChecks = array();
        //Empezamos suponiendo que es valida la onda e iremos marcando lo contrario en caso de que no se cumpla
        $continuous = true;
        $xRepeater = false;
        /** @var Point $point */
        foreach($wave->getTrail() as $point){

            //En el primer elemento no tenemos nada que comprobar
            if(is_null($lastPoint)){
                $lastPoint = $point;
                $xChecks[$point->getX()] = $point->getY();
                continue;
            }

            //Si ya no es continua no hace falta que comprobemos
            if($continuous && $point->getX() < $lastPoint->getX() ){
                $continuous = false;
            }

            //Si ya no cumple la condición de un único elemento por eje x no hace falta que comprobemos
            if(!$xRepeater && isset($xRepeater[$point->getX()])){
                //Ojo que puede ser que sea creciente o descendiente sobre paralelo a las y, por eso sumamos el continued error de margen
                if( ($xRepeater[$point->getX()]+$this->maxContinuedError) < $point->getY() ){
                    $xRepeater = true;
                }
            }

            //Guardamos el punto en el array que usamos como ayudante para controlar los repetidos en el eje x
            $xChecks[$point->getX()] = $point->getY();
            //Establecemos le punto anterior al actual antes de pasar al siguiente del recorrido
            $lastPoint = $point;
        }


        return $continuous && !$xRepeater;
    }
}