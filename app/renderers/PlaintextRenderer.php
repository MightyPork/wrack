<?php namespace MightyPork\Wrack;


class PlaintextRenderer extends Renderer
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
	public function do_render($body)
	{
		$ra = new RenderedArticle;
		$ra->body = '<pre class="body_plain">' . htmlentities($body, ENT_HTML5 | ENT_QUOTES) . '</pre>';
		return $ra;
	}
}

