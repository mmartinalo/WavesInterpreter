<?php


namespace WavesInterpreter\ColorGuesser;

use WavesInterpreter\ImageMetadata;

/**
 * Class AbstractGuesserColorStrategy
 * @package WavesInterpreter\ColorGuesser
 */
abstract class AbstractGuesserColorStrategy {

    /**
     * @param ImageMetadata $image_metadata
     * @return int
     */
    abstract function guessWaveColor(ImageMetadata $image_metadata);
} 