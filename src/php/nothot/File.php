<?php

namespace nothot;

class File {
	private $_name;
	private $_tmpName;
	private $_tmpPath;
	private $_hash;
	private $_mime;
	private $_extension;
	private $_size;
	private $_description;

	public function __constructor($file_array) {
		$this->_name = $file_array['name'];
		$this->_tmpName = $file_array['tmp_name'];
		return $this;
	}

	public function name() {
		return $this->_name;
	}

	public function tmpName() {
		return $this->_tmpName;
	}

	public function tmpPath() {
		return $this->_tmpPath;
	}

	public function hash() {
		return sha1_file($this->_tmpName);
	}

	public function size() {
		return $this->_size;
	}
}

?>