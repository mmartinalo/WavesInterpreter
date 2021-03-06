<?php


namespace WavesInterpreter;


use WavesInterpreter\Exception\WavePointException;
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

        /** @var Point $maxPoint */
        $maxPoint = null;
        /** @var Point $currentPoint */
        foreach($points as $currentPoint){

            //Nos hacen falta al menos dos puntos para poder comparar
            if(is_null($maxPoint)){
                $maxPoint = $currentPoint;
                continue;
            }

            //Si el actual es mayor o igual seteamos este como el mayor. En caso de igualdad nos quedamos con el último
            if($currentPoint->getY() >= $maxPoint->getY()){
                $maxPoint = $currentPoint;
            }

        }

        //Si el array no contiene elementos devolverá null ya que no entra en el foreach
        return $maxPoint;
    }

    /**
     * Dado un array de Points obtiene el punto mínimo de todos ellos
     *
     * @param array $points
     * @return null|\WavesInterpreter\Point\Point
     */
    static function getMinPointTrail(array $points){

        //Si solo tenemos un punto, es el máximo
        if(count($points) == 1){
            return $points[0];
        }

        /** @var Point $maxPoint */
        $minPoint = null;
        /** @var Point $currentPoint */
        foreach($points as $currentPoint){

            //Nos hacen falta al menos dos puntos para poder comparar
            if(is_null($minPoint)){
                $minPoint = $currentPoint;
                continue;
            }

            //Si el actual es menor o igual seteamos este como el mayor. En caso de igualdad nos quedamos con el último
            if($currentPoint->getY() <= $minPoint->getY()){
                $minPoint = $currentPoint;
            }

        }

        //Si el array no contiene elementos devolverá null ya que no entra en el foreach
        return $minPoint;
    }

    /**
     * Este helper no ordena! devuelve la distancia entre el primer y último elemento
     *
     * @param array $points
     * @throws WavePointException
     * @return null|int
     */
    static public  function getXDistance(array $points = array()){

        if(!count($points)){
            return 0;
        }

        //Solo podemos devolver una distancia si es un array de por lo menos dos elementos
        if(count($points)  == 1 ){
            return 1;
        }

        $firstPoint = array_slice($points,0,1)[0];
        $lastPoint = array_slice($points,-1,1)[0];

        if(!$firstPoint instanceof Point || !$lastPoint instanceof Point){
            throw new WavePointException("Error obteniendo la distancia X entre puntos");
        }

        return abs($lastPoint->getX() - $firstPoint->getX());
    }

    /**
     * Devuelve la distancia entre el elemento con mayot potencial y el que menos
     *
     * @param array $points
     * @throws WavePointException
     * @return null|int
     */
    static public  function getYDistance(array $points = array()){

        if(!count($points)){
            return 0;
        }

        if(count($points) == 1){
            return 1;
        }

        //Si llegamos hasta aquí no tenemos que validar que nos devuelve una instancia en lugar de null
        $minPoint = self::getMinPointTrail($points);
        $maxPoint = self::getMaxPointTrail($points);

        return $maxPoint->getY() - $minPoint->getY();
    }
} 