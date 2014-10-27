<?php namespace MightyPork\Wrack;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

class Article
{
	/** Article name */
	public $name;
	/** Canonical name, useful for permalinks & tracking */
	public $canonical;
	/** Datum of article creation */
	public $created;
	/** Article description to be shown in listing */
	public $description = '';
	/** Article tags (array) */
	public $tags = array();
	/** Main file */
	public $body_file = '';

	public function __construct($path)
	{
		if(!Navigator::isArticle($path))
			throw new HtmlException(404, "There is no article at: '$path'");

		$yaml = new Parser();
		$source = Resource::read($path . '/article.yml');

		try {
			$options = $yaml->parse($source);
		} catch (ParseException $e) {
			throw new StructureException('Could not parse article options: '.$path, $e);
		}

		$this->name			= Util::arrayGet($options, 'name');
		$this->canonical	= Util::arrayGet($options, 'canonical');
		$this->created 		= Util::arrayGet($options, 'created');

		$this->description	= Util::arrayGetOptional($options, 'description', '');
		$this->tags			= Util::arrayGetOptional($options, 'tags', []);

		$this->body_file	= Util::arrayGetOptional($options, 'body', null);
		// TODO find the right body file.

		var_dump($options);

		// TODO handle options
	}

}
