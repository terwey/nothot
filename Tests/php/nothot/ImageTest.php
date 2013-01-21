<?php

namespace nothot;

use nothot\File;

class ImageTest extends \PHPUnit_Framework_TestCase {
	function testNewImage() {
		$image = new Image();
		return $image;
	}

	/**
	 * @depends testNewImage
	 **/
	function testGetImageId(Image $image) {
		$image->imageId();
	}

	/**
	 * @depends testNewImage
	 **/
	function testGetImageName(Image $image) {
		$image->imageName();
	}

	/**
	 * @depends testNewImage
	 **/
	function testImageFromFile(Image $image) {
		$file = new File();
		$image->fromFile($file);
	}
}
?>
