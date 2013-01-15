<?php

Class database {
	private $dbfile;

	public function __construct() {
		$sqlitefile = ROOTDIR . '/db.sqlite3';
		$sqlitepath = 'sqlite:'.$sqlitefile;
		if (file_exists($sqlitefile)) {
			try {
				$this->dbfile = new PDO($sqlitepath);
				$this->dbfile->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		} else {
			// in case it doesn't exist, do a DB setup
			// this is a repeat, has to be cleaned up
			if (fopen($sqlitefile, 'w') or die('Cannot open file:  '.$sqlitefile)) {
				try {
					$this->dbfile = new PDO($sqlitepath);
					$this->dbfile->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->setupDB();
				} catch(PDOException $e) {
					die($e->getMessage());
				}
			}
		}
	}

	public function insertImage($data) {
		if (is_array($data)) {
			$insert = 'INSERT INTO image (hash, date, extension, originalname, title, description)
			VALUES (:hash, datetime(), :extension, :originalname, :title, :description)';
			$stmt = $this->dbfile->prepare($insert);

			$stmt->bindParam(':hash', $data['hash']);
			$stmt->bindParam(':extension', $data['extension']);
			$stmt->bindParam(':originalname', $data['originalname']);
			$stmt->bindParam(':title', $data['title']);
			$stmt->bindParam(':description', $data['description']);

			$stmt->execute();
		} else {
			die('$data must be an array!');
		}
	}

	public function setupDB() {
		$imageTable = 'CREATE TABLE image (
			id INTEGER PRIMARY KEY,
			date INTEGER,
			hash TEXT,
			extension TEXT,
			originalname TEXT,
			title TEXT,
			description TEXT
		);';
		$nothotTable = 'CREATE TABLE nothot (
			id INTEGER PRIMARY KEY,
			notscore INTEGER,
			hotscore INTEGER,
			ratedImage INTEGER,
			FOREIGN KEY(ratedImage) REFERENCES image(id)
		);';

		$this->dbfile->exec($imageTable);
		$this->dbfile->exec($nothotTable);
	}
}

?>
