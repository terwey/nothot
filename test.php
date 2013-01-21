<?php
namespace nothot;
require_once('vendor/autoload.php');

$files = array(
	'file_valid'    =>  array(
		'name'      =>  'foo.txt',
		'tmp_name'  =>  '/tmp/php42up23',
		'type'      =>  'text/plain',
		'size'      =>  42,
		'error'     =>  0
	)
);

var_dump($files['file_valid']);

$file = new File($files['file_valid']);
print $file->name();

?>
