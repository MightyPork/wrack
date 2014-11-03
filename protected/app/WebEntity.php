<?php namespace MightyPork\Wrack;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

/**
 * Some common code for groups adn articles
 */
abstract class WebEntity
{
	/** Entity name */
	public $name;

	/** Entity description to be shown in listing */
	public $description;

	/** Entity path */
	public $path;

	/** Parent group inbstance (cache) */
	protected $_group;

	/** Cached relative path to header image */
	protected $_header;
	protected $_header_r = false;

	/** Cached relative path to icon image */
	protected $_icon;
	protected $_icon_r = false;


	/**
	 * Load entity YAML config file
	 */
	protected function loadOptions($path, $yamlFile)
	{
		$this->path = Util::fixAbsPath("/$path/");

		$yaml = new Parser();
		$source = Resource::read($path . '/' . $yamlFile);

		try {
			$options = $yaml->parse($source);
		} catch (ParseException $e) {
			throw new StructureException('Could not parse entity options: '.$path, $e);
		}

		$this->readOptions($options);
	}


	/**
	 * Init entity from YAML options
	 */
	protected function readOptions($options)
	{
		$this->name = Util::arrayGet($options, 'name');
		$this->description = Util::arrayGetOptional($options, 'description', '');
		$this->opt_iconfile = Util::arrayGetOptional($options, 'icon', null);
		$this->opt_headerfile = Util::arrayGetOptional($options, 'header', null);
	}


	/** Get article parent group */
	public function getGroup()
	{
		if($this->_group != null || $this->path == '/')
			return $this->_group;

		$path = rtrim($this->path, '/');
		if($path == '') $path = '/'; // won't happen

		$group_path = substr($path, 0, strrpos($path, '/'));

		return $this->_group = new Group($group_path);
	}



	/** Get header image path */
	public function getHeader()
	{
		if($this->_header_r)
			return $this->_header;

		$namesToTry = [
			$this->opt_headerfile,
			'header.jpg',
			'title.jpg',
			'top.jpg',
			'header.png',
			'title.png',
			'top.png',
			'header.gif',
			'title.gif',
			'top.gif',
		];

		foreach($namesToTry as $n) {
			if($n==null) continue;

			if(Resource::isFile($this->path . '/' . $n)) {
				$this->_header = Util::fixAbsPath($this->path . '/'. $n);
				break;
			}
		}

		$this->_header_r = true;
		return $this->_header;
	}


	/** Get icon image path */
	public function getIcon()
	{
		if($this->_icon_r)
			return $this->_icon;

		$namesToTry = [
			$this->opt_iconfile,
			'icon.jpg',
			'thumbnail.jpg',
			'icon.png',
			'thumbnail.png',
			'icon.gif',
			'thumbnail.gif',

			$this->opt_headerfile,
			'header.jpg',
			'title.jpg',
			'top.jpg',
			'header.png',
			'title.png',
			'top.png',
			'header.gif',
			'title.gif',
			'top.gif',
		];

		foreach($namesToTry as $n) {
			if($n==null) continue;

			if(Resource::isFile($this->path . '/' . $n)) {
				$this->_icon = Util::fixAbsPath($this->path . '/'. $n);
				break;
			}
		}

		$this->_icon_r = true;
		return $this->_icon;
	}
}
