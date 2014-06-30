<?php


namespace WavesInterpreter;


use WavesInterpreter\Point\Point;

/**
 * Class WaveInterpreterUtils
 * @package WavesInterpreter
 */
final class WaveInterpreterUtils {

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
} 