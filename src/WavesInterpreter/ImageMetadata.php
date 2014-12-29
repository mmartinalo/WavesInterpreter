<?php

namespace WavesInterpreter;


use WavesInterpreter\Exception\ImageMetadataException;

/**
 * Class ImageMetadata
 * @package WavesInterpreter
 */
class ImageMetadata {


    /** @var  array[int][int] */
    protected $imageMap;

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
        return $this->imageMap;
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

        //Si ya estaba seteado tenemos que restar uno al color que tuviese guardado
        if(isset($this->imageMap[$x]) && isset($this->imageMap[$x][$y])){
            //Si solo había un color hacemos un unset
            if($this->colors[$this->imageMap[$x][$y]] == 1){
                unset($this->colors[$this->imageMap[$x][$y]]);
            }else{
                //Si no le restamos uno
                $this->colors[$this->imageMap[$x][$y]] = $this->colors[$this->imageMap[$x][$y]] -1;
            }
        }


        $this->imageMap[$x][$y] = $color;
        if(isset($this->colors[$color])){
            ++$this->colors[$color];
            return;
        }

        $this->colors[$color] = 1;
    }

} 