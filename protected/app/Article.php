<?php namespace MightyPork\Wrack;

/**
 * Article entity
 */
class Article extends WebEntity
{
	public static $renderers;

	/** Canonical name, useful for permalinks & tracking */
	public $canonical;

	/** Datum of article creation */
	public $created;

	/** Article author name */
	public $author;

	/** Article tags (array) */
	public $tags;

	/** Body file name requested in options. May be null. */
	private $opt_bodyfile;


	/** Cached body file content */
	private $_body;

	/** Cached body file extension */
	private $_body_ext;

	/** Cached body file extension */
	private $_body_file;

	/** Cached body file extension */
	private $_body_mime;

	/** Cached rendered article html */
	private $_rendered;


	public function __construct($path)
	{
		if(!Navigator::isArticle($path))
			throw new HtmlException(404, "There is no article at: '$path'");

		$this->loadOptions($path, 'article.yml');
	}


	/* override */
	protected function readOptions($options)
	{
		parent::readOptions($options);

		// get creation date
		$s = Util::arrayGet($options, 'created');
		if(is_int($s))
			$this->created = $s;
		else {
			if(preg_match('/^\d{4}-\d{2}-\d{2}$/', $s))
				$s = str_replace('-', '/',$s);
			$this->created = strtotime($s);
		}

		// more article metadata
		$this->opt_bodyfile = Util::arrayGetOptional($options, 'body', null);
		$this->canonical = Util::arrayGet($options, 'canonical');
		$this->tags	  = Util::arrayGetOptional($options, 'tags', []);
		$this->author = Util::arrayGetOptional($options, 'author', App::cfg('default_author'));
	}



	/** Get article body (raw) */
	public function getBody()
	{
		if($this->_body != null)
			return $this->_body;

		$f = $this->opt_bodyfile;

		if($f == null) {
			// try to find suitable file for the article body

			$names = array('body', 'index', 'article', 'main');
			$exts = array('md', 'html', 'txt');

			foreach($names as $n) {
				foreach($exts as $e) {
					if(Resource::isFile("{$this->path}/$n.$e")) {
						$f = "$n.$e";
						break;
					}
				}

				if($f != null) break;
			}

			if($f == null) {
				throw new StructureException("Could not resolve article body file at: $path/?");
			}

		} elseif(!Resource::isFile("{$this->path}/$f")) {
			// check if given name exists
			throw new StructureException("Article body file not found: $path/$f");
		}


		// resolve markup type
		$this->_body_ext = pathinfo($this->path . '/' . $f, PATHINFO_EXTENSION);
		$this->_body_mime = Resource::getMime($this->path . '/' . $f);
		$this->_body_file = $f;

		return $this->_body = Resource::read($this->path . '/' . $f);
	}


	/** Render the article. Returns RenderedArticle. */
	public function render()
	{
		if($this->_rendered != null) return $this->_rendered;

		$body = $this->getBody();

		if($this->_rendered == null) {
			foreach(self::$renderers as $r) {
				if($r->acceptsMime($this->_body_mime)) {
					$this->_rendered = $r->render($body);
					break;
				}
			}
		}

		if($this->_rendered == null) {
			foreach(self::$renderers as $r) {
				if($r->acceptsExt($this->_body_ext)) {
					$this->_rendered = $r->render($body);
					break;
				}
			}
		}

		// last resort
		if($this->_rendered == null) {
			$plainr = new PlaintextRenderer;
			$this->_rendered = $plainr->render($body);
		}

		return $this->_rendered;
	}
}

Article::$renderers = array(new MarkdownRenderer, new PlaintextRenderer, new HtmlRenderer);
