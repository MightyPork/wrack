<?php namespace MightyPork\Wrack;


class PlaintextRenderer implements IRenderer
{
	/* override */
	public function acceptsMime($mime)
	{
		return $mime == 'text/plain';
	}


	/* override */
	public function acceptsExt($ext)
	{
		return strtolower($ext) == 'txt';
	}


	/* override */
	public function render($body)
	{
		$ra = new RenderedArticle;
		$ra->body = '<pre class="body_plain">' . htmlentities($body, ENT_HTML5 | ENT_QUOTES) . '</pre>';
		return $ra;
	}
}

