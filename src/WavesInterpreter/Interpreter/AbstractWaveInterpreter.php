<?php

namespace WavesInterpreter\Interpreter;


use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ColorGuesser\Strategy\EasyGuesserWaveColorStrategy;
use WavesInterpreter\Exception\WaveInterpreterException;
use WavesInterpreter\Factory\WaveFactory;
use WavesInterpreter\Factory\Wave\ComplexWaveFactory;
use WavesInterpreter\ImageMetadata;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Point\Point;
use WavesInterpreter\Wave\Proxy\ProxyWave;

/**
 * Class AbstractWaveInterpreter
 * @package WavesInterpreter\Interpreter
 */
abstract class AbstractWaveInterpreter {

    const MAX_COLOR_VALUE = 16777215;

    protected $binarizationColors = array();


    /** @var  WaveFactory */
    protected  $waveFactory;

    /**
     * Algoritmo que adivina el color de la onda en la imagen
     *
     * @var \WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy
     */
    protected $guesserStrategy;


    /**
     * Número mñaximo de intentos que tiene el adivinador para acertar con el color de la onda
     *
     * @var int
     */
    protected $maxGuesserAttempts = 2;

    /**
     * Límite de puntos sobre el eje y que estamos dispuestos a asumir como margen de error
     *
     * @var int
     */
    protected  $limitEdgeError = 2;

    /**
     * Límite de puntos sobre el eje x que estamos dispuestos a asumir como margen de error
     *
     * @var int
     */
    protected  $limitContinuityError = 2;


    /**
     * La binarización la vamos a hacer sobre 32 colores
     * El color FFFFFF se corresponde con el decimal 16777215 por lo que
     * nuestro rango de agrupar los colores será de 524288
     *
     * @param WaveFactory $waveFactory
     * @param AbstractGuesserColorStrategy $guesser
     * @param int $numColorsBinarization
     */
    public function __construct(
        WaveFactory $waveFactory = null,
        AbstractGuesserColorStrategy $guesser = null,
        $numColorsBinarization = 32)
    {

        if(!$waveFactory){
            $waveFactory = ComplexWaveFactory::getInstance();
        }

        $this->waveFactory = $waveFactory;

        if(!$guesser instanceof AbstractGuesserColorStrategy){
            $guesser = new EasyGuesserWaveColorStrategy();
        }

        $this->guesserStrategy = $guesser;

        $colorInt = 0;
        while($colorInt < self::MAX_COLOR_VALUE){
            $this->binarizationColors[] = $colorInt;
            //Lo redondeamos sin ningun decimal, queremos enteros
            $colorInt += round(self::MAX_COLOR_VALUE/$numColorsBinarization, 0);
        }

    }

    /**
     * 1 - Leer recurso
     * 2 - Binarización
     * 3 - Fragmentación/Segmentación (Wave isolation)
     * 4 - Validación
     * 5 - Adelgazamiento de la onda
     * 5 - Return
     *
     *
     * @param string $resource
     * @param int $waveColor
     *
     * @throws \WavesInterpreter\Exception\WaveInterpreterException
     *
     * @return AbstractWave
     */
    public function createWave($resource, $waveColor = null)
    {
        //Dejamos una puerta abierta para el Template Method
        $this->initCreateWave();

        //Paso 1: Leer recurso
        $gdImage = $this->loadResource($resource);

        if(!is_resource($gdImage)){
            throw new WaveInterpreterException("No se leer el recurso que me has dado");
        }
        //Paso 2: Binarización
        $imageMetadata = $this->binarization($gdImage, $waveColor);

        //Reseteamos a 0 los colores encontrados por le guesser
        $this->guesserStrategy->resetGuessedColors();

        $validator = $this->waveFactory->createValidator();

        $attempts = 0;
        $find = false;
        $wave = null;

        //Minentras no la hayamos encontrado y no hayamos superado el número máximo de intentos
        while(!$find && $attempts < $this->maxGuesserAttempts){

            //Paso 3: Fragmentación/Segmentación
            $wave = $this->waveIsolation($imageMetadata->getImageMap(), $this->guesserStrategy->guessWaveColor($imageMetadata));

            //Dejamos una puerta abierta para el Template Method
            $this->preValidate();

            //Paso 4: Validación
            if($validator->validate($wave)){
                $find = true;
            }
            //Dejamos una puerta abierta para el Template Method
            $this->postValidate();

            $attempts++;
        }

        if($wave instanceof AbstractWave){
            //Paso 5: Adelgazamiento de la onda
            $wave = new ProxyWave($this->thinningWave($wave));
        }

        //Dejamos una puerta abierta para el Template Method
        $this->finishCreateWave();

        return $wave;
    }


    /**
     * Lee el recurso proporcionado
     *
     * @param string
     * @return resource
     */
    abstract protected function loadResource($resource);

    /**
     * Crea una ImageMetadata que será lo que sabemos interpretar de manera genérica para el recurso proporcionado
     *
     * @param $gdImage
     * @param null $waveColor
     * @return ImageMetadata
     */
    abstract protected function binarization($gdImage, $waveColor = null);


    /** Se llama al inicio del método createWave */
    protected function initCreateWave(){}

    /** Se llama al final del método createWave */
    protected function finishCreateWave(){}

    /** Se llama antes de validar la onda */
    protected function preValidate(){}

    /** Se llama después de validar la onda */
    protected function postValidate(){}


    /**
     * @param array $arrayMap
     * @param $waveColor
     *
     * @return \WavesInterpreter\Wave\AbstractWave
     */
    protected function waveIsolation(array $arrayMap, $waveColor)
    {

        //Flag que se pondrá a cierto una vez empecemos a interpretar
        //todo esto se puede evitar y optimizar la interpretación si guardasemos la posición de la primera aparición para los colores
        $waveStart = false;
        //Entero que usaremos para acumular el error actual sobre el eje de las x
        $continuityBlank = 0;

        $wave = $this->waveFactory->createWave();

        $finishedX= $stepColorFound =false;
        $currentX = $currentY = 0;

        //realmente count($array_map) es igual que $image_metadata->getWidth()
        while(!$finishedX  && $currentX < count($arrayMap) ){

            if($waveStart){
                //Si hemos empezado a interpretar la onda y no encontramos continuidad en la columna anterior sumamos 1 al error de continuidad
                //En caso de que si lo hubiesemos encontrado lo dejamos a 0 el error de continuidad
                $continuityBlank = ($stepColorFound) ? 0 : $continuityBlank+1;

                if($continuityBlank > $this->limitContinuityError){
                    $finishedX = true;
                }

            }
            //todo borrar esto cuando estes seguro que count($array_map) funciona
            //Comprobamos que existe, si no existe está mal formado el array_map...
//            if(!isset($array_map[$currentX])){
//                break;
//            }

            $yValues = $arrayMap[$currentX];

            //Entero que usaremos para acumular el error sobre el eje de las y
            $edgeError = 0;
            $stepColorFound = false;
            $finishedY =false;
            //realmente count($yValues) es igual que $image_metadata->getHeigth()
            while(!$finishedY && $currentY < count($yValues)){

                //todo borrar esto cuando estes seguro que count($y_values) funciona
//                //Comprobamos que existe, si no existe está mal formado el array_map...
//                if(!isset($y_values[$current_y])){
//                    $finished_x = true;
//                    break;
//                }
                //Si el color de este punto coincide con el de la onda lo guardamos
                if($yValues[$currentY] == $waveColor){
                    $waveStart = true;
                    $stepColorFound = true;
                    $edgeError = 0;
                    $wave->addPoint(new Point($currentX,$currentY));
                } else if($stepColorFound && ++$edgeError > $this->limitEdgeError){
                    //Si habíamos encontrado un punto de la onda para esta posición y sobrepasamos el margen pasamos de columnna
                    $finishedY = true;
                }

                $currentY++;
            }
            //OJO: Si ya hemos encontrado la onda en la columna actual continuamos por $this->limit_edge_error posiciones más abajo que la última,
            // es decir dos veces limit_edge_error, ya que una vez limit_edge_error es la ubicación del punto ya que añadió margen para seguir buscando
            //pero tenemos que controlar que es como mucho la posición 0, que nos vams del array si no
            // si no, seteamos la y a 0
            $currentY = ($stepColorFound) ? max($currentY - ($this->limitEdgeError * 2),0 ): 0;
            //aumentamos una posición en el eje de las x
            $currentX++;
        }

        return $wave;

    }

    /**
     *
     * @param $wave
     * @return mixed
     */
    private function thinningWave($wave)
    {
        //todo queremos adelgazar la onda??

        return $wave;
    }

} 