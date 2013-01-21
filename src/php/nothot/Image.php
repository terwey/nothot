<?php

namespace nothot;

use nothot\File;

class Image {
	private $imageId;
	private $imageName;

	public function __constructor() {
		$this->imageId = '1';
		$this->imageName = 'test.jpg';
		return $this;
	}

	public function fromFile(File $file) {
		
	}

	public function imageId() {
		return $this->imageId;
	}

	public function imageName() {
		return $this->imageName;
	}
}