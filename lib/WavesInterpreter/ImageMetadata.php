<?php


namespace WavesInterpreter;
use WavesInterpreter\Exception\ImageMetadataException;

/**
 * Class ImageMetadata
 * @package WavesInterpreter
 */
class ImageMetadata {

    /** @var  array[int][int] */
    protected $image_map;

    /** @var  array ; clave => representación del color en número,  valor => numbero de repeticiones  */
    protected $colors;

    /** @var  int */
    protected $width;

    /** @var  int */
    protected $height;

    /**
     * @return array
     */
    public function getImageMap()
    {
        return $this->image_map;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }


    /**
     * @return array
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $color
     * @throws Exception\ImageMetadataException
     */
    public function addPixel($x,$y, $color)
    {
        if($x <0 || $y < 0){
            throw new ImageMetadataException("El punto con cooredadas x: $x y coordenada y:$y  no es válido");
        }

        if( $color < 0 || $color > 255){
            throw new ImageMetadataException("El color: $color no es válido. Coordenadas x:$x  y:$y ");
        }

        //No comprobamos si ya había algo, lo guardamos directamente
        $this->image_map[$x][$y] = $color;


        if(isset($this->colors[$color])){
            ++$this->colors[$color];
            return;
        }

        $this->colors[$color] = 1;
    }


    /**
     * De momento devolemos el color que menos veces aparezca
     *
     * @return int
     */
    public function guessWaveColor()
    {
        //todo esto hay que meterle chicha con su patroncito de diseño y todo

        if(!count($this->colors)){
            return 0;
        }

        $selected_key = $min_repetitions = null;
        foreach($this->colors as $key => $repetitions){
            if(is_null($selected_key)){
                $selected_key = $key;
                $min_repetitions = $repetitions;
                continue;
            }

            if($min_repetitions > $repetitions){
                $selected_key = $key;
                $min_repetitions = $repetitions;
            }
        }

        return $this->colors[$selected_key];
    }

} 