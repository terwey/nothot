<?php

// $config = yaml_parse_file('config.yml');
include('config.inc.php');
include('classes/Image.inc.php');

if (!empty($_FILES['image'])) {
	$image = new Image($_FILES['image']);
}

print getImages(999);

print '<form enctype="multipart/form-data" action="index.php" method="POST">';
print 'Send this file: <input name="image" type="file" />';
print '<input type="submit" value="Send File" />';
print '</form>';

?>