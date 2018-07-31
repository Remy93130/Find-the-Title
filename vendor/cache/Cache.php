<?php

namespace vendor\cache\Cache;

/**
 *  @author Barberet Remy
 *  @version 1.0.0 
 * Insert data into a temp file for avoid too much request to the database
 */
class Cache {

	/**
	 * Path to the file
	 * @var string
	 */
	private $path;

	/**
	 * Valid duration for the file in second
	 * @var int
	 */
	private $lifeTime;
	
	/**
	 * Build the object
	 * @param string  $path     folder to store temp files
	 * @param integer $lifeTime the duration to change data
	 */
	function __construct($path, $lifeTime=600) {
		$this->path = $path;
		$this->lifeTime = $lifeTime;
	}

	/**
	 * Insert content in a file
	 * @param  string $fileName the name of the file
	 * @param   $content  the data to store
	 */
	public function write($fileName, $content) {
		return file_put_contents($this->path . '/' . $fileName, $content);
	}

	/**
	 * Check if file is readable and get data inside
	 * @param  string $fileName the name of the file
	 * @return string           data in the file
	 */
	public function read($fileName)	{
		$file = $this->path . $fileName;
		if (!file_exists($file)) {
			return false;
		}
		$lifeTime = (time() - filemtime($file));
		if ($lifeTime > $this->lifeTime) {
			return false;
		}
		return file_get_contents($file);
	}

	/**
	 * Delete the file
	 * @param  string $fileName the name of the file
	 */
	public function delete($fileName) {
		$file = $this->path . ' / ' . $fileName;
		if (file_exists($file)) {
			unlink($file);
		}
	}

	/**
	 * Remove all file in the folder
	 */
	public function clearCache() {
		$files = glob($this->path . '/*');
		foreach ($files as $file) {
			unlink($file);
		}
	}
}

?>