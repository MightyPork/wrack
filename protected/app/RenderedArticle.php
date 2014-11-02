<?php namespace MightyPork\Wrack;

/**
 * Article data rendered using a renderer.
 */
class RenderedArticle
{
	/**
	 * Extra HTML code to be added to the head
	 */
	public $head = '';

	/**
	 * Article body, in HTML. Ready to be shown in the article view.
	 */
	public $body;


	public function __tostring()
	{
		return trim($head . "\n" . $body);
	}
}
