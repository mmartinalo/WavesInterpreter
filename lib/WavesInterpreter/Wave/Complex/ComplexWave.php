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

    /** @var int constante que usaremos como margen de error para generar crestas y valles*/
    const PIXEL_ERROR_MARGIN = 5;

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

        //Para no estar actualizando valores en cada adicción de un punto lo haremos en los mismos getter
        $this->crest = null; //El array vaio indica que no tiene crestas
        $this->trough = null; //El array vaio indica que no tiene valles
        $this->is_sinusoidal = null;
        $this->max_point = null;
        $this->min_point = null;

    }



    /**
     * @return array[Point]
     */
    public function getCrest()
    {
        //El array vaio indica que no tiene crestas, sd, nulo si no se han generado todavía
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
        //El array vaio indica que no tiene crestas, sd, nulo si no se han generado todavía
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

    private function generateCrestsAndTrough()
    {

        $this->crest = array();
        $this->trough = array();

        //array que rellenaremos con la parte del recorrido de tamaño self::PIXEL_ERROR_MARGIN
        $last_points = array();
        /** @var Point $point */
        foreach($this->getTrail() as $point){

            $last_points[] = $point;
            if(count($last_points) < self::PIXEL_ERROR_MARGIN){
                //Hasta que no tenga el tamaño mínimo continuamos
                continue;
            }

            //El elemento insertado más antiguo es el candidato a ser analizado
            /** @var Point $candidate */
            $candidate = array_shift($last_points);


            throw new WaveException("TODO hay que ver como hacer esto, xq el código de a continuación se traga la situación de rampa");
            //Si el candidato es mayor que el punto actual, es candidato para ser cresta
            if($candidate->getY() > $point->getY()  && WaveInterpreterUtils::isMaximum($candidate, $last_points)){
                $this->crest[] = $candidate;
            }

            //Si el candidato es menor que el punto actual, es candidato para ser valle
            if($candidate->getY() < $point->getY()  && WaveInterpreterUtils::isMinimum($candidate, $last_points)){
                $this->trough[] = $candidate;
            }

        }


    }


}