<?php namespace MightyPork\Wrack;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

class Group
{
	/** Group name */
	public $name;
	/** Group description to be shown in listing */
	public $description;
	/** Child groups */
	public $group_paths;
	/** Child articles */
	public $article_paths;
	/** Group path */
	public $path;

	private $_group;

	public function __construct($path)
	{
		if(!Navigator::isGroup($path))
			throw new HtmlException(404, "There is no group at: '$path'");

		$this->path = preg_replace('#/+#', '/', "/$path/");

		$yaml = new Parser();
		$source = Resource::read($path . '/group.yml');

		try {
			$options = $yaml->parse($source);
		} catch (ParseException $e) {
			throw new StructureException('Could not parse group options: '.$path, $e);
		}

		$this->name = Util::arrayGet($options, 'name');
		$this->description = Util::arrayGetOptional($options, 'description', '');

		$children = Navigator::listGroup($this->path);
		$this->group_paths = $children->groups;
		$this->article_paths = $children->articles;
	}



	/** Get article parent group */
	public function getGroup()
	{
		if($this->_group != null || $this->path == '/')
			return $this->_group;

		$path = rtrim($this->path, '/');
		if($path == '') $path = '/'; // won't happen

		$group_path = substr($path, 0, strrpos($path, '/'));

		return $this->group = new Group($group_path);
	}
}
