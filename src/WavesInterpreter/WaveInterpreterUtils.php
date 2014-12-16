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
        $isMax = true;
        foreach($points as $point){

            if(!$point instanceof Point){
                break;
            }

            //Al meter $is_max en la condición, cuando $candidate->getY() >  $point->getY() no sea cierto, ya nunca será cierto
            $isMax = ($isMax && $candidate->getY() >  $point->getY());
        }

        return $isMax;
    }

    static function isMinimum(Point $candidate, array $points)
    {
        //Si el array de puntos está vacío consideramos cierto que es mínimo
        $isMin = true;
        foreach($points as $point){

            if(!$point instanceof Point){
                break;
            }

            //Al meter $is_min en la condición, cuando $candidate->getY() <  $point->getY() no sea cierto, ya nunca será cierto
            $isMin = ($isMin && $candidate->getY() <  $point->getY());
        }

        return $isMin;
    }

    /**
     * Dados dos puntos, devuele la constante de la clase correspondiente a la progresión entre ambos:
     *  'up', 'straight', 'down'
     *
     * @param Point $firstPoint
     * @param Point $secondPoint
     *
     * @return string
     */
    static function getProgression(Point $firstPoint, Point $secondPoint)
    {
        if($firstPoint->getY() > $secondPoint->getY()){

            $progression = self::WAVE_PROGRESSION_DOWN;

        } else if($firstPoint->getY() < $secondPoint->getY()){

            $progression = self::WAVE_PROGRESSION_UP;
        } else {

            $progression = self::WAVE_PROGRESSION_STRAIGHT;
        }

        return $progression;
    }

    /**
     * Dado un array de Points obtiene el punto máximo de todos ellos
     *
     * @param array $points
     * @return null|\WavesInterpreter\Point\Point
     */
    static function getMaxPointTrail(array $points){

        //Si solo tenemos un punto, es el máximo
        if(count($points) == 1){
            return $points[0];
        }

        /** @var Point $lastPoint */
        $maxPoint = null;
        /** @var Point $currentPoint */
        foreach($points as $currentPoint){

            //Nos hacen falta al menos dos puntos para poder comparar
            if(is_null($lastPoint)){
                $maxPoint = $currentPoint;
                continue;
            }

            //Si el actual es mayor o igual seteamos este como el mayor. En caso de igualdad nos quedamos con el último
            if($currentPoint->getY() >= $lastPoint->getY()){
                $maxPoint = $currentPoint;
            }

        }

        //Si el array no contiene elementos devolverá null ya que no entra ene l foreach
        return $maxPoint;
    }
} 