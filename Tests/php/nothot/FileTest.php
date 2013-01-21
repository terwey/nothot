<?php

namespace nothot;

class FileTest extends \PHPUnit_Framework_TestCase {
	private $_files_array;

	protected function setUp() {
		$this->_files_array = array(
			'file_valid'    =>  array(
				'name'      =>  'foo.txt',
				'tmp_name'  =>  '/tmp/php42up23',
				'type'      =>  'text/plain',
				'size'      =>  42,
				'error'     =>  0
			)
		);
	}

	protected function tearDown() {
		$this->_files_array = array();
	}

	function testNewFile() {
		var_dump($this->_files_array['file_valid']);
		$file = new File($this->_files_array['file_valid']);
		$this->assertInstanceOf('nothot\File', $file);
		$this->assertEquals('foo.txt', $file->name());
		return $file;
	}

	/**
	 * @depends testNewFile
	 **/
	function testGetFileName(File $file) {
		$this->assertEquals('foo.txt', $file->name());
	}

	/**
	 * @depends testNewFile
	 **/
	function testGetFileTmpName(File $file) {
		$this->assertEquals('/tmp/php42up23', $file->tmpName());
	}

	/**
	 * @depends testNewFile
	 **/
	function testGetFileTmpPath(File $file) {
		$this->assertEquals('/tmp/', $file->tmpPath());
	}

	/**
	 * @depends testNewFile
	 **/
	// function testGetFileHash(File $file) {
	// 	$file->hash();
	// }

	/**
	 * @depends testNewFile
	 **/
	function testGetFileSize(File $file) {
		$this->assertEquals(42, $file->size());
	}
}
?>
