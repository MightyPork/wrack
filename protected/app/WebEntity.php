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

	/** Cached relative path to icon image */
	protected $_icon;


	/**
	 * Load entity YAML config file
	 */
	protected function loadOptions($path, $yamlFile)
	{
		$this->path = preg_replace('#/+#', '/', "/$path/");

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
		if($this->_header != null)
			return $this->_header;

		do {
			if(Resource::isFile($this->path . '/' . $this->opt_headerfile)) {
				$this->_header = $this->opt_headerfile;
				break;
			}

			if(Resource::isFile($this->path . '/header.jpg')) {
				$this->_header = 'header.jpg';
				break;
			}

			if(Resource::isFile($this->path . '/header.png')) {
				$this->_header = 'header.png';
				break;
			}

			$this->_header = '/images/header-default.jpg';
		} while(false);

		return $this->_header;
	}


	/** Get icon image path */
	public function getIcon()
	{
		if($this->_icon != null)
			return $this->_icon;

		do {
			if(Resource::isFile($this->path . '/' . $this->opt_iconfile)) {
				$this->_icon = $this->opt_iconfile;
				break;
			}

			if(Resource::isFile($this->path . '/icon.jpg')) {
				$this->_icon = 'icon.jpg';
				break;
			}

			if(Resource::isFile($this->path . '/icon.png')) {
				$this->_icon = 'icon.png';
				break;
			}

			$this->_icon = '/images/icon-default.jpg';
		} while(false);

		return $this->_icon;
	}
}
