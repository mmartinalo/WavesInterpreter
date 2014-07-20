<?php


namespace WavesInterpreter;


use WavesInterpreter\Point\Point;

/**
 * Class WaveInterpreterUtils
 * @package WavesInterpreter
 */
final class WaveInterpreterUtils {

    //Esto en vez de constante podrían ser clases, ganaríamos algo?
    const WAVE_PROGRESSION_UP = 'up';
    const WAVE_PROGRESSION_STRAIGHT = 'straight';
    const WAVE_PROGRESSION_DOWN = 'down';

    /**
     * @param Point $p1
     * @param Point $p2
     * @return bool
     */
    static function equals(Point $p1, Point $p2)
    {
        return $p1->getX() == $p2->getX() && $p1->getY() == $p2->getY();
    }

    static function isMaximum(Point $candidate, array $points)
    {
        //Si el array de puntos está vacío consideramos cierto que es máximo
        $is_max = true;
        foreach($points as $point){

            if(!$point instanceof Point){
                break;
            }

            //Al meter $is_max en la condición, cuando $candidate->getY() >  $point->getY() no sea cierto, ya nunca será cierto
            $is_max = ($is_max && $candidate->getY() >  $point->getY());
        }

        return $is_max;
    }

    static function isMinimum(Point $candidate, array $points)
    {
        //Si el array de puntos está vacío consideramos cierto que es mínimo
        $is_min = true;
        foreach($points as $point){

            if(!$point instanceof Point){
                break;
            }

            //Al meter $is_min en la condición, cuando $candidate->getY() <  $point->getY() no sea cierto, ya nunca será cierto
            $is_min = ($is_min && $candidate->getY() <  $point->getY());
        }

        return $is_min;
    }

    /**
     * Dados dos puntos, devuele la constante de la clase correspondiente a la progresión entre ambos:
     *  'up', 'straight', 'down'
     *
     * @param Point $first_point
     * @param Point $second_point
     *
     * @return string
     */
    static function getProgression(Point $first_point, Point $second_point)
    {
        if($first_point->getY() > $second_point->getY()){

            $progression = self::WAVE_PROGRESSION_DOWN;

        } else if($first_point->getY() < $second_point->getY()){

            $progression = self::WAVE_PROGRESSION_UP;
        } else {

            $progression = self::WAVE_PROGRESSION_STRAIGHT;
        }

        return $progression;
    }
} 