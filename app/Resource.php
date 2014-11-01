<?php namespace MightyPork\Wrack;

use Defr\MimeType;

/**
 * Class that takes care of resolving and serving resources from the data directory.
 */
class Resource
{
	private static $valid_files = [];


	private static $restricted_filenames = array(
		'.gitignore',
		'.gitkeep',
		'.htaccess',
		'article.yml',
		'index.md',
		'index.html',
		'index.htm',
	);


	public static function listSubDirectories($path)
	{
		$dirs = glob(DATA_DIR . $path . '/*' , GLOB_ONLYDIR);

		$rd_datadir = realpath(DATA_DIR);

		$rdirs = array();
		foreach($dirs as $d) {
			$rd = realpath($d);

			if(strpos($rd, $rd_datadir) === 0) {
				$rd = substr($rd, strlen($rd_datadir));
				$rd = trim($rd, '/');
			}

			$rdirs[] = $rd;
		}

		return $rdirs;
	}


	/** Make sure the path refers to an actual file in the data storage */
	private static function verifyFile($path)
	{
		if(in_array($path, self::$valid_files)) return;

		if(!self::isFile($path))
			throw new HtmlException(404, "No such file: '$path'");

		self::$valid_files[] = $path;
	}


	/* Get mime type for a file */
	private static function getMime($path)
	{
		self::verifyFile($path);
		return MimeType::get(DATA_DIR . $path);
	}


	/** Check if file exists, is file and accessible */
	public static function isFile($path)
	{
		$uri = DATA_DIR . $path;
		return file_exists($uri) && is_readable($uri) && is_file($uri);
	}


	/** Check if file exists, is directory and accessible */
	public static function isDirectory($path)
	{
		$uri = DATA_DIR . $path;
		return file_exists($uri) && is_readable($uri) && is_dir($uri);
	}


	/** Check if file is restricted to accessing by route */
	public static function isRestricted($path)
	{
		// do not let anyone into the git repository (if any)
		if(strpos($path, '.git') === 0)
			return true;

		// check fi file exists
		self::verifyFile($path);

		// check against blacklist
		$name = pathinfo(DATA_DIR . $path, PATHINFO_BASENAME);
		return (in_array(strtolower($name), self::$restricted_filenames));
	}


	/** Send file to user */
	public static function send($path)
	{
		if(self::isRestricted($path))
			throw new HtmlException(403, "File not accessible: '$path'");

		self::verifyFile($path);

		// send.
		$mime = self::getMime($path);
		header("Content-type: $mime");

		readfile(DATA_DIR . $path);
	}


	/** Read file to string */
	public static function read($path)
	{
		self::verifyFile($path);
		return file_get_contents(DATA_DIR . $path);
	}
}
