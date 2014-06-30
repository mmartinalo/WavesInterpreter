<?php

namespace WavesInterpreter\Interpreter;


use WavesInterpreter\Factory\WaveFactory;
use WavesInterpreter\Factory\Wave\ComplexWaveFactory;
use WavesInterpreter\ImageMetadata;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Point\Point;

/**
 * Class AbstractWaveInterpreter
 * @package WavesInterpreter\Interpreter
 */
abstract class AbstractWaveInterpreter {

    /** @var  WaveFactory */
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


    public function __construct(WaveFactory $wave_factory = null)
    {
        if(!$wave_factory){
            $wave_factory = ComplexWaveFactory::getInstance();
        }
        $this->wave_factory = $wave_factory;
    }

    /**
     * 1 - Leer recurso
     * 2 - Ccrear ImageMap
     * 3 - Adivinar color de la onda
     * 4 - Crear onda desde ImageMap
     * 5 - Validar onda
     * 6 - return Onda
     *
     * @param string $resource
     * @param int $wave_color
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

        $finished_x= $step_color_found =false;
        $current_x = $current_y = 0;

        while(!$finished_x  && $current_x < $image_metadata->getWidth() ){

            if($wave_start){
                //Si hemos empezado a interpretar la onda y no encontramos continuidad en la columna anterior sumamos 1 al error de continuidad
                //En caso de que si lo hubiesemos encontrado lo dejamos a 0 el error de continuidad
                $continuity_blank = ($step_color_found) ? 0 : $continuity_blank+1;

                if($continuity_blank > $this->limit_continuity_error){
                    $finished_x = true;
                }

            }

            //Comprobamos que existe, si no existe está mal formado el array_map...
            if(!isset($array_map[$current_x])){
                break;
            }

            $y_values = $array_map[$current_x];

            //Entero que usaremos para acumular el error sobre el eje de las y
            $edge_error = 0;
            $step_color_found = false;
            $finished_y =false;
            while(!$finished_y && $current_y < $image_metadata->getHeight()){

                //Comprobamos que existe, si no existe está mal formado el array_map...
                if(!isset($y_values[$current_y])){
                    $finished_x = true;
                    break;
                }
                //Si el color de este punto coincide con el de la onda lo guardamos
                if($y_values[$current_y] == $wave_color){
                    $wave_start = true;
                    $step_color_found = true;
                    $edge_error = 0;
                    $wave->addPoint(new Point($current_x,$current_y));
                } else if($step_color_found && ++$edge_error > $this->limit_edge_error){
                    //Si habíamos encontrado un punto de la onda para esta posición y sobrepasamos el margen pasamos de columnna
                    $finished_y = true;
                }

                $current_y++;
            }
            //OJO: Si ya hemos encontrado la onda en la columna actual continuamos por $this->limit_edge_error posiciones más abajo que la última,
            // es decir dos veces limit_edge_error, ya que una vez limit_edge_error es la ubicación del punto ya que añadió margen para seguir buscando
            //pero tenemos que controlar que es como mucho la posición 0, que nos vams del array si no
            // si no, seteamos la y a 0
            $current_y = ($step_color_found) ? max($current_y - ($this->limit_edge_error * 2),0 ): 0;
            //aumentamos una posición en el eje de las x
            $current_x++;
        }

        return $wave;

    }

} 