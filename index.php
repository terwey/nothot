<?php

// $config = yaml_parse_file('config.yml');
include('config.inc.php');
include('classes/Image.inc.php');

if ($_GET['parse'] != 'y') {
?>
<form enctype="multipart/form-data" action="index.php?parse=y" method="POST">
Send this file: <input name="image" type="file" />
<input type="submit" value="Send File" />
</form>
<?php
} else {
	var_dump($_POST);
	var_dump($_FILES['image']);

	$image = new Image($_FILES['image']);
	// print $image->originalFileName();
}

?>