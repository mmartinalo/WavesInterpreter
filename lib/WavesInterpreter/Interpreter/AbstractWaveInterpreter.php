<?php

namespace WavesInterpreter\Interpreter;

use WavesInterpreter\Factory\Wave\SimpleWaveFactory;
use WavesInterpreter\Factory\WaveAbstractFactory;
use WavesInterpreter\Factory\WaveInterpreter\HashMapWaveFactory;
use WavesInterpreter\ImageMetadata;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Point;

/**
 * Class AbstractWaveInterpreter
 * @package WavesInterpreter\Interpreter
 */
abstract class AbstractWaveInterpreter {

    /** @var  WaveAbstractFactory */
    protected  $wave_factory;

    /**
     * Límite de puntos sobre el eje y que estamos dispuestos a asumir como margen
     *
     * @var int
     */
    protected  $limit_edge_error = 2;

    /**
     * Límite de puntos sobre el eje x que estamos dispuestos a asumir como margen
     *
     * @var int
     */
    protected  $limit_continuity_error = 2;


    public function __construct($type = 'Simple')
    {
        $this->wave_factory =($type == 'Simple') ?
            SimpleWaveFactory::getInstance()
            :
            HashMapWaveFactory::getInstance();
    }

    /**
     * 1 - Leer recurso
     * 2 - Ccrear ImageMap
     * 3 - Adivinar color de la onda
     * 4 - Crear onda desde ImageMap
     * 5 - Validar onda
     * 6 - return Onda
     *
     * @param $resource
     * @param null $wave_color
     * @return AbstractWave
     */
    abstract function createWave($resource, $wave_color = null);

    /**
     * @param ImageMetadata $image_metadata
     * @return AbstractWaveInterpreter|\WavesInterpreter\Wave\AbstractWave
     */
    protected function createWaveFromMetadata(ImageMetadata $image_metadata)
    {
        $array_map = $image_metadata->getImageMap();
        $wave_color = $image_metadata->guessWaveColor();

        //Flag que se pondrá a cierto una vez empecemos a interpretar
        $wave_start = false;
        //Entero que usaremos para acumular el error actual sobre el eje de las x
        $continuity_blank = 0;

        $wave = $this->wave_factory->createWave();
        //todo para que sea más efectivos, vambiar el foreach por whiles, y que empiece en la siguiente columna $this->limit_edge_error posiciones más abajo que la actual

        foreach($array_map as $x => $y_values){

            if($wave_start){
                //Si hemos empezado a interpretar la onda y no encontramos continuidad en la columna anterior sumamos 1 al error de continuidad
                //En caso de que si lo hubiesemos encontrado lo dejamos a 0 el error de continuidad
                $continuity_blank = ($x_color_found) ? 0 : $continuity_blank+1;

                if(++$continuity_blank > $this->limit_continuity_error){
                    break;
                }

            }

            //Entero que usaremos para acumular el error sobre el eje de las y
            $edge_error = 0;
            $x_color_found = false;

            foreach($y_values as $y => $color){
                if($x_color_found){
                    ++$edge_error;
                    if($edge_error > $this->limit_edge_error)
                    {
                        break;
                    }
                }


                if($color == $wave_color){
                    $wave_start = true;
                    $x_color_found = true;
                    $edge_error = 0;
                    $wave->addPoint(new Point($x,$y));
                }
            }

        }

        return $wave;
    }

} 