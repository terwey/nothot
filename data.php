<?php

include('config.inc.php');
include('Library/nothot/Image.php');

if (isset($_GET['id'])) {
	$image = new Image($_GET['id']);
	header('Content-type: application/json');
	print $image->getImage();
}

?>
