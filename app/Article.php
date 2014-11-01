<?php namespace MightyPork\Wrack;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;
use Michelf\MarkdownExtra;

class Article
{
	/** Article name */
	public $name;
	/** Path to the article folder */
	public $path;
	/** Canonical name, useful for permalinks & tracking */
	public $canonical;
	/** Datum of article creation */
	public $created;
	/** Article description to be shown in listing */
	public $description;
	/** Article author name */
	public $author;
	/** Article tags (array) */
	public $tags;
	/** Main file */
	public $body_file;
	/** Markup type (md, html, txt) */
	public $markup;
	/** Cached body file content */
	private $_body;
	/** Cached rendered article html */
	private $_rendered;


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

		$this->path = $path;
		$this->name = Util::arrayGet($options, 'name');
		$this->canonical = Util::arrayGet($options, 'canonical');

		$s = Util::arrayGet($options, 'created');

		if(is_int($s))
			$this->created = $s;
		else {
			if(preg_match('/^\d{4}-\d{2}-\d{2}$/', $s))
				$s = str_replace('-', '/',$s);

			$this->created = strtotime($s);
		}

		$this->description = Util::arrayGetOptional($options, 'description', '');
		$this->tags	= Util::arrayGetOptional($options, 'tags', []);
		$this->author = Util::arrayGetOptional($options, 'author', App::cfg('default_author'));

		$f = Util::arrayGetOptional($options, 'body', null);

		if($f == null) {
			// try to find suitable file for the article body

			$names = array(
				'body',
				'index',
				'article',
				'main'
			);

			$exts = array(
				'md',
				'html',
				'txt',
			);

			foreach($names as $n) {
				foreach($exts as $e) {
					if(Resource::isFile("$path/$n.$e")) {
						$f = "$n.$e";
						break;
					}
				}
				if($f != null) break;
			}

			if($f == null) {
				throw new StructureException("Could not resolve article body file at: $path/?");
			}

		} elseif(!Resource::isFile("$path/$f")) {
			// check if given name exists
			throw new StructureException("Article body file not found: $path/$f");
		}


		// resolve markup type
		$ext = pathinfo($f, PATHINFO_EXTENSION);

		switch($ext) {
			case 'md':
				$mu = 'md';
				break;
			case 'html':
			case 'htm':
				$mu = 'html';
				break;
			default:
				$mu = 'txt';
		}

		$this->markup = $mu;

		// store
		$this->body_file = $f;
	}


	/** Get article body (raw) */
	public function getBody()
	{
		if($this->_body != null)
			return $this->_body;

		$c = Resource::read($this->path . '/' . $this->body_file);
		$this->_body = $c;
		return $c;
	}


	/** Render using the markup, to html. */
	public function render()
	{
		if($this->_rendered != null)
			return $this->_rendered;

		$body = $this->getBody();

		switch($this->markup)
		{
			case 'txt':
				$this->_rendered = "<pre>$body</pre>";
				break;

			case 'md':
				$md = new MarkdownExtra;
				$this->_rendered = $md->transform($body);
				break;

			case 'html':
			default:
				$this->_rendered = $body;
		}

		return $this->_rendered;
	}
}
