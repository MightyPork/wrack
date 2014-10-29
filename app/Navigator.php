<?php namespace MightyPork\Wrack;

/**
 * Utility for high-level interacting with the data storage
 */
class Navigator
{
	/** Check if given path is valid article */
	public static function isArticle($path)
	{
		return Resource::isDirectory($path) && Resource::isFile($path.'/article.yml');
	}


	/** Check if given path is valid group */
	public static function isGroup($path)
	{
		return Resource::isDirectory($path) && Resource::isFile($path.'/group.yml');
	}


	/**
	 * List articles and sub-groups in a group
	 *
	 * returns object{articles:[paths], groups:[paths]}
	 */
	public static function listGroup($path)
	{
		$dirs = Resource::listSubDirectories($path);

		$articles = array();
		$groups = array();

		foreach($dirs as $p) {
			if(self::isArticle($p)) {
				$articles[] = $p;
			} elseif(self::isGroup($p)) {
				$groups[] = $p;
			}
		}

		return (object) ['articles' => $articles, 'groups' => $groups];
	}
}
