<?php

require('config.inc.php');
require('classes/Image.inc.php');

include('header.inc.php');

if (!empty($_FILES['image'])) {
	$image = new Image($_FILES['image']);
}


print '<div id="images"></div>';
// print getImages(999);

print '<form enctype="multipart/form-data" action="index.php" method="POST">';
print 'Send this file: <input name="image" type="file" />';
print '<input type="submit" value="Send File" />';
print '</form>';

include('footer.inc.php');

?>