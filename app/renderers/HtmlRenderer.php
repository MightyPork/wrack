<?php namespace MightyPork\Wrack;


class HtmlRenderer implements IRenderer
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
	public function render($body)
	{
		$ra = new RenderedArticle;
		$ra->body = Util::shiftHeadings($body, 1);
		return $ra;
	}
}

