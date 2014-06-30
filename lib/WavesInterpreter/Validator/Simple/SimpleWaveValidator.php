<?php


namespace WavesInterpreter\Validator\Simple;


use WavesInterpreter\Exception\WaveValidatorException;
use WavesInterpreter\Point\Point;
use WavesInterpreter\Validator\AbstractWaveValidator;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Simple\SimpleWave;

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

        //Si no llega a la longitud mínima establecida no lo validamos
        if($wave->getTrail()->count() < $this->getMinLength()){
            return false;
        }

        //Comprobamos tres puntos:
        // 1 - continuidad
        // 3 - en el eje x no puede haber dos puntos separados demasiado espacio

        /** @var Point $last_point */
        $last_point = null;
        //Lo usaremos para ver que no se repiten en el  mismo eje dos puntos
        $x_checks = array();
        //Empezamos suponiendo que es valida la onda e iremos marcando lo contrario en caso de que no se cumpla
        $continuous = true;
        $x_repeater = false;
        /** @var Point $point */
        foreach($wave->getTrail() as $point){

            //En el primer elemento no tenemos nada que comprobar
            if(is_null($last_point)){
                $last_point = $point;
                $x_checks[$point->getX()] = $point->getY();
                continue;
            }

            //Si ya no es continua no hace falta que comprobemos
            if($continuous && $point->getX() < $last_point->getX() ){
                $continuous = false;
            }

            //Si ya no cumple la condición de un único elemento por eje x no hace falta que comprobemos
            if(!$x_repeater && isset($x_repeater[$point->getX()])){
                //Ojo que puede ser que sea creciente o descendiente sobre paralelo a las y, por eso sumamos el continued error de margen
                if( ($x_repeater[$point->getX()]+$this->max_continued_error) < $point->getY() ){
                    $x_repeater = true;
                }
            }

            //Guardamos el punto en el array que usamos como ayudante para controlar los repetidos en el eje x
            $x_checks[$point->getX()] = $point->getY();
            //Establecemos le punto anterior al actual antes de pasar al siguiente del recorrido
            $last_point = $point;
        }


        return $continuous && !$x_repeater;
    }
}