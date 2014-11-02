<?php namespace MightyPork\Wrack;

/**
 * Group entity (folder)
 */
class Group extends WebEntity
{
	/** Child groups */
	public $group_paths;
	/** Child articles */
	public $article_paths;


	public function __construct($path)
	{
		if(!Navigator::isGroup($path))
			throw new HtmlException(404, "There is no group at: '$path'");

		$this->loadOptions($path, 'group.yml');

		$children = Navigator::listGroup($this->path);
		$this->group_paths = $children->groups;
		$this->article_paths = $children->articles;
	}


	/* override */
	protected function readOptions($options)
	{
		parent::readOptions($options);

		// extra stuff
	}
}
