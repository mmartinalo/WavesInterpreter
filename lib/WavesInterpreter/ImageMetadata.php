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

        //No comprobamos si ya había algo, lo guardamos directamente
        $this->image_map[$x][$y] = $color;

        //todo guardarnos la posición de la primera aparición de cada color

        if(isset($this->colors[$color])){
            ++$this->colors[$color];
            return;
        }

        $this->colors[$color] = 1;
    }

} 