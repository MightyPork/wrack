<?php namespace MightyPork\Wrack;

class Navigator
{
	public static function isArticle($path)
	{
		return Resource::isDirectory($path) && Resource::isFile($path.'/article.yml');
	}


	public static function isGroup($path)
	{
		return Resource::isDirectory($path) && Resource::isFile($path.'/group.yml');
	}
}
