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
			die('sqlite db does not exist: '. $sqlitefile);
		}
	}

	public function insertImage($data) {
		if (is_array($data)) {
			$insert = 'INSERT INTO image (hash, date, extension, originalname, title, description)
			VALUES (:hash, datetime(), :extension, :originalname, :title, :description)';
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
