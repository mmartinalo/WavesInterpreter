<?php

namespace WavesInterpreter\Wave\Complex;

use WavesInterpreter\Exception\WaveException;
use WavesInterpreter\Point\Point;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\WaveInterpreterUtils;


/**
 * Class ComplexWave
 * @package WavesInterpreter\Wave\Complex
 */
class ComplexWave extends AbstractWave{

    /** @var array[Point] */
    protected $crest = null;

    /** @var array[Point] */
    protected $trough = null;

    /** @var bool  */
    protected $isSinusoidal = null;

    /** @var  int */
    protected $frequency = 0;

    /** @var Point  */
    protected $maxPoint = null;

    /** @var Point  */
    protected $minPoint = null;


    /**
     * @param Point $point
     */
    public function addPoint(Point $point)
    {


        //Lo añadimos al recorrido, quien somos para negarselo
        $this->trail->addPoint($point);

        //Para no estar actualizando crestas y valles en cada adicción de un punto lo haremos en los mismos getter
        $this->crest = null; //El array vacio indica que no tiene crestas
        $this->trough = null; //El array vacio indica que no tiene valles
        $this->isSinusoidal = null;
        $this->maxPoint = null;
        $this->minPoint = null;

    }



    /**
     * @return array[Point]
     */
    public function getCrest()
    {
        //El array vacio indica que no tiene crestas, sd, nulo si no se han generado todavía
        if(is_null($this->crest)){
            $this->generateCrestsAndTrough();
        }

        return $this->crest;
    }

    /**
     * @return array[Point]
     */
    public function getTrough()
    {
        //El array vacio indica que no tiene crestas, sd, nulo si no se han generado todavía
        if(is_null($this->trough)){
            $this->generateCrestsAndTrough();
        }

        return $this->trough;
    }



    /**
     * @return bool
     */
    public function isSinusoidal()
    {
        if(is_null($this->isSinusoidal)){
            $this->checkSinusoidal();
        }

        return $this->isSinusoidal;
    }

    /**
     * @return Point
     */
    public function getMaxPoint()
    {
        if(!$this->maxPoint instanceof Point){
            $this->generateMaxMin();
        }

        return $this->maxPoint;
    }

    /**
     * @return Point
     */
    public function getMinPoint()
    {
        if(!$this->maxPoint instanceof Point){
            $this->generateMaxMin();
        }

        return $this->minPoint;
    }


    private function generateMaxMin()
    {
        /** @var Point $point*/
        foreach($this->getTrail() as $point){

            //MinPoint solo hay uno, el primero que encuentre se queda en caso de igualdad
            if(!$this->minPoint instanceof Point){
                $this->minPoint = $point;
            }else if($this->minPoint->getY() > $point->getY()){
                $this->minPoint = $point;
            }

            //MaxPoint solo hay uno, el primero que encuentre se queda en caso de igualdad
            if(!$this->maxPoint instanceof Point){
                $this->maxPoint = $point;
            }else if($this->maxPoint->getY() < $point->getY()){
                $this->maxPoint = $point;
            }

        }
    }

    private function checkSinusoidal()
    {
        throw new WaveException("TODO: implementarlo!!");
    }

    /**
     * Genera los array de crest y trough a partir de los puntos existentes actualmente en trail
     *
     * @throws \WavesInterpreter\Exception\WaveException
     */
    private function generateCrestsAndTrough()
    {

        $this->crest = array();
        $this->trough = array();

        //variable con las que guardaremos la proguesión anterior de la onda y el punto para poder comparar
        $lastProgression = null;
        /** @var Point $lastPoint */
        $lastPoint = null;
        /** @var Point $currentPoint */
        foreach($this->getTrail() as $currentPoint){

            //Nos hacen falta al menos dos puntos apra poder comparar
            if(!$lastPoint instanceof Point){
                $lastPoint = $currentPoint;
                continue;
            }

            //Obtenemos la progresión actual
            $currentProgression = WaveInterpreterUtils::getProgression($lastPoint,$currentPoint );
            //La primera vez que pasemos no tenemos $last_progression
            switch($currentProgression){
                case WaveInterpreterUtils::WAVE_PROGRESSION_UP:

                    if($lastProgression == WaveInterpreterUtils::WAVE_PROGRESSION_DOWN){
                        $this->trough[] = $currentPoint;
                    }
                    $lastProgression = $currentProgression;
                    break;

                case WaveInterpreterUtils::WAVE_PROGRESSION_STRAIGHT :
                    //No hacemos nada. Tampoco actualizamos el last_progression!!
                    break;

                case WaveInterpreterUtils::WAVE_PROGRESSION_DOWN:

                    if($lastProgression == WaveInterpreterUtils::WAVE_PROGRESSION_UP){
                        $this->crest[] = $currentPoint;
                    }
                    $lastProgression = $currentProgression;
                    break;
            }

            $lastPoint = $currentPoint;
        }


    }

}