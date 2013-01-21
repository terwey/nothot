<?php

namespace nothot;

class Image {
	private $file;
	private $tmpFile;
	private $fileMIME;
	private $fileExtension;
	private $fileSize;

	private $filedescription;

	private $originalname;

	// Eventually users should be able to mark something as a duplicate
	// and then the files can be merged. Filehashes need to be able to be
	// added to the receiving Image.
	private $filehash;

	public function __construct($file) {
		$this->file = $file;
		if (is_array($this->file)) { // let's assume it's a new image
			$this->processImage();
		}
	}

	private function processImage() {
		$this->originalname = $this->file['name'];
		$this->tmpFile = $this->file['tmp_name'];
		if ($this->checkFileMIME($this->file['type'])) {
			$this->saveImage();
		} else {
			die('Illegal file type');
		}
	}

	private function saveImage() {
		$hash = sha1_file($this->tmpFile);
		$destination = ROOTDIR .'/'. DATADIR .'/'. $hash .'.'. $this->fileExtension;

		if (!file_exists($destination)) {
			if (!move_uploaded_file($this->tmpFile, $destination)) {
				if (!is_writable(dirname($destination))) {
					die(dirname($destination) . ' is not writable');
				} else {
					die('Upload was not a file.');
				}
			} else {
				$db = new database();
				$data = array(
					'hash' => $hash,
					'extension' => $this->fileExtension,
					'originalname' => $this->originalname,
					'title' => $this->originalname,
					'description' => $this->originalname
				);
				$db->insertImage($data);
			}
		} else {
			die('File already exists');
		}
	}

	public function getImage() {
		$db = new database();
		$result = $db->getImage($this->file);

		$info = array(
			'id' => $result['id'],
			'title' => $result['title'],
			'src' => DATADIR .'/'. $result['hash'] .'.'. $result['extension']
		);
		if ($result) {
			return json_encode($info);
		}
	}

	private function checkFileMIME($mime) {
		$types = array(
				'image/jpeg',
				'image/jpg',
				'image/png'
			);

		if (in_array(strtolower($mime), $types)) {
			// safe file
			if ($mime == 'image/jpeg' || $this->fileMIME == 'image/jpg' ) {
				$this->fileExtension = 'jpg';
			} else if ($mime == 'image/png') {
				$this->fileExtension = 'png';
			}
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

// deprecated!
function getImages($amount) {
	$db = new database();
	$result = $db->getImages($amount);

	foreach ($result as $image) {
		print '<strong>'.$image['title'].'</strong><br /><img src=" '. DATADIR .'/'. $image['hash'] .'.'. $image['extension'].'" /> <br /><br />';
	}
}

?>