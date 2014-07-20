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
    protected $is_sinusoidal = null;

    /** @var  int */
    protected $frequency = 0;

    /** @var Point  */
    protected $max_point = null;

    /** @var Point  */
    protected $min_point = null;


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
        $this->is_sinusoidal = null;
        $this->max_point = null;
        $this->min_point = null;

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
        if(is_null($this->is_sinusoidal)){
            $this->checkSinusoidal();
        }

        return $this->is_sinusoidal;
    }

    /**
     * @return Point
     */
    public function getMaxPoint()
    {
        if(!$this->max_point instanceof Point){
            $this->generateMaxMin();
        }

        return $this->max_point;
    }

    /**
     * @return Point
     */
    public function getMinPoint()
    {
        if(!$this->max_point instanceof Point){
            $this->generateMaxMin();
        }

        return $this->min_point;
    }


    private function generateMaxMin()
    {
        /** @var Point $point*/
        foreach($this->getTrail() as $point){

            //MinPoint solo hay uno, el primero que encuentre se queda en caso de igualdad
            if(!$this->min_point instanceof Point){
                $this->min_point = $point;
            }else if($this->min_point->getY() > $point->getY()){
                $this->min_point = $point;
            }

            //MaxPoint solo hay uno, el primero que encuentre se queda en caso de igualdad
            if(!$this->max_point instanceof Point){
                $this->max_point = $point;
            }else if($this->max_point->getY() < $point->getY()){
                $this->max_point = $point;
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
        $last_progression = null;
        /** @var Point $last_point */
        $last_point = null;
        /** @var Point $current_point */
        foreach($this->getTrail() as $current_point){

            //Nos hacen falta al menos dos puntos apra poder comparar
            if(!$last_point instanceof Point){
                $last_point = $current_point;
                continue;
            }

            //Obtenemos la progresión actual
            $current_progression = WaveInterpreterUtils::getProgression($last_point,$current_point );
            //La primera vez que pasemos no tenemos $last_progression
            switch($current_progression){
                case WaveInterpreterUtils::WAVE_PROGRESSION_UP:

                    if($last_progression == WaveInterpreterUtils::WAVE_PROGRESSION_DOWN){
                        $this->trough[] = $current_point;
                    }
                    $last_progression = $current_progression;
                    break;

                case WaveInterpreterUtils::WAVE_PROGRESSION_STRAIGHT :
                    //No hacemos nada. Tampoco actualizamos el last_progression!!
                    break;

                case WaveInterpreterUtils::WAVE_PROGRESSION_DOWN:

                    if($last_progression == WaveInterpreterUtils::WAVE_PROGRESSION_UP){
                        $this->crest[] = $current_point;
                    }
                    $last_progression = $current_progression;
                    break;
            }

            $last_point = $current_point;
        }


    }

}