<?php namespace MightyPork\Wrack;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

class Group
{
	/** Article name */
	public $name;
	/** Article description to be shown in listing */
	public $description = '';

	public function __construct($path)
	{
		if(!Navigator::isGroup($path))
			throw new HtmlException(404, "There is no group at: '$path'");

		$yaml = new Parser();
		$source = Resource::read($path . '/group.yml');

		try {
			$options = $yaml->parse($source);
		} catch (ParseException $e) {
			throw new StructureException('Could not parse group options: '.$path, $e);
		}

		var_dump($options);

		// TODO handle options
	}
}
