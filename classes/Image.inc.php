<?php



class Image {
	private $file;
	private $tmpfile;
	private $filemime;
	private $fileExtension;

	private $filedescription;

	private $filename;

	// Eventually users should be able to mark something as a duplicate
	// and then the files can be merged. Filehashes need to be able to be
	// added to the receiving Image.
	private $filehash;

	public function __construct($file) {
		$this->file = $file;
		$this->processImage();
	}

	private function processImage() {
		$this->filename = $this->file['name'];
		$this->tmpFile = $this->file['tmp_name'];
		$this->filemime = $this->file['type'];
		if ($this->checkFileMIME()) {
			$this->saveFile();
		} else {
			die('Illegal file type');
		}
	}

	private function saveFile() {
		$hash = sha1_file($this->tmpFile);
		$destination = ROOTDIR .'/'. DATADIR .'/'. $hash .'.'. $this->fileExtension;
		print $destination;
		if (!move_uploaded_file($this->tmpFile, $destination)) {
			if (!is_writable(dirname($destination))) {
				echo dirname($destination) . ' is not writable';
			} else {
				die('Upload was not a file.');
			}
		}
	}

	private function checkFileMIME() {
		$types = array(
				'image/jpeg',
				'image/jpg',
				'image/png'
			);

		if (in_array(strtolower($this->filemime), $types)) {
			// safe file
			if ($this->filemime == 'image/jpeg' || $this->filemime == 'image/jpg' ) {
				$this->fileExtension = 'jpg';
			} else if ($this->filemime == 'image/png') {
				$this->fileExtension = 'png';
			}
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function originalFileName() {
		return $this->filename;
	}
}

?>