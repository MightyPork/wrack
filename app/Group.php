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
	public $groups;
	/** Child articles */
	public $articles;
	/** Group path */
	public $path;

	public function __construct($path)
	{
		if(!Navigator::isGroup($path))
			throw new HtmlException(404, "There is no group at: '$path'");

		$this->path = trim($path,'/');

		$yaml = new Parser();
		$source = Resource::read($path . '/group.yml');

		try {
			$options = $yaml->parse($source);
		} catch (ParseException $e) {
			throw new StructureException('Could not parse group options: '.$path, $e);
		}

		$this->name = Util::arrayGet($options, 'name');
		$this->description = Util::arrayGetOptional($options, 'description', '');

		// attempt to find articles

		$children = Navigator::listGroup($path);

		$this->groups = $children->groups;
		$this->articles = $children->articles;
	}
}
