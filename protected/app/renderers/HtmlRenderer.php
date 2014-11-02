<?php namespace MightyPork\Wrack;


class HtmlRenderer extends Renderer
{
	/* override */
	public function acceptsMime($mime)
	{
		return $mime == 'text/html';
	}


	/* override */
	public function acceptsExt($ext)
	{
		return in_array(strtolower($ext), ['html', 'htm']);
	}


	/* override */
	public function do_render($body)
	{
		$ra = new RenderedArticle;
		$ra->body = $body;
		return $ra;
	}
}

