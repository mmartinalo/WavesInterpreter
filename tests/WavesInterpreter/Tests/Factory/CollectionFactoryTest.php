<?php


namespace WavesInterpreter\Tests\Factory;

use WavesInterpreter\Factory\PointCollection\HashMapCollectionFactory;
use WavesInterpreter\Factory\PointCollection\SimpleCollectionFactory;

/**
 * Class CollectionFactoryTest
 * @package WavesInterpreter\Tests\Factory
 */
class CollectionFactoryTest extends \PHPUnit_Framework_TestCase
{



	public function testSimpleCollectionFactory()
	{
		$collectionFactory = SimpleCollectionFactory::getInstance();

		$this->assertInstanceOf(
		     'WavesInterpreter\Point\PointCollection\SimplePointCollection\SimplePointCollection'
			     , $collectionFactory->createCollection()
		);

	}

	public function testHashMapCollectionFactory()
	{
		$collectionFactory = HashMapCollectionFactory::getInstance();

		$this->assertInstanceOf(
		     'WavesInterpreter\Point\PointCollection\HashMapPointCollection\HashMapPointCollection'
			     , $collectionFactory->createCollection()
		);

	}
}