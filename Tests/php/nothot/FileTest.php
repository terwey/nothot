<?php

namespace nothot;

class FileTest extends \PHPUnit_Framework_TestCase {
	protected function setUp() {
		$_FILES = array(
			'file_valid'    =>  array(
				'name'      =>  'foo.txt',
				'tmp_name'  =>  '/tmp/php42up23',
				'type'      =>  'text/plain',
				'size'      =>  42,
				'error'     =>  0
			)
		);
	}

	function testNewFile() {
		var_dump($_FILES['file_valid']);
		$file = new File($_FILES['file_valid']);
		$this->assertInstanceOf('nothot\File', $file);
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
	function testGetFileHash(File $file) {
		$file->hash();
	}

	/**
	 * @depends testNewFile
	 **/
	function testGetFileSize(File $file) {
		$this->assertEquals(42, $file->size());
	}
}
?>
