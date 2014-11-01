<?php namespace MightyPork\Wrack;

use Michelf\MarkdownExtra;

class MarkdownRenderer implements IRenderer
{
	/* override */
	public function acceptsMime($mime)
	{
		return $mime == 'text/markdown';
	}


	/* override */
	public function acceptsExt($ext)
	{
		return strtolower($ext) == 'md';
	}


	/* override */
	public function render($body)
	{
		$ra = new RenderedArticle;
		$ra->body = self::processMarkDown($body);
		return $ra;
	}


	protected static function processMarkDown($text)
	{
		$mdMacros = array(
			// blockquote cite note
			"#^>\s*--\s*(.*)$#im" => "\n> <cite>$1</cite>\n",

			// youtube
			"#@\[(.*?)\]\s*\(([a-z0-9.-]+)\)#i"
				=> '<iframe class="youtube" width="560" height="315" src="http://www.youtube.com/embed/$2?wmode=opaque" frameborder="0" allowfullscreen>$1</iframe>',

			// block of code with language specified
			"#`{3,}#i" => "~~~", // ``` to ~~~
			"#^~{3,}[ ]*([a-zA-Z]+)[ ]*$#im" => "\n~~~ {.$1}\n",
		);

		$text = Util::pregReplaceKV($mdMacros, $text);

		$parser = new MarkdownExtra;
		// modify attrs
		$text = $parser->transform($text);


		$cleanupStr = array(
			'\[' => '[',
			'\]' => ']',
			'<code class="terminal">' => '<code class="no-highlight terminal">',
		);

		$text = Util::strReplaceKV($cleanupStr, $text);


		$cleanupPreg = array(
			'#<p>\s*\$#is'=>'<p class="intro">',
			'#align="(.*?)"#'=>'style="text-align:$1;"',
			// "#\n[ ]{16}#" => "\n\t\t\t\t",
			// "#\n[ ]{12}#" => "\n\t\t\t",
			// "#\n[ ]{8}#" => "\n\t\t",
			// "#\n[ ]{4}#" => "\n\t",
		);

		$text = Util::pregReplaceKV($cleanupPreg, $text);


		$text = Util::shiftHeadings($text, 1);

		return $text;
	}
}

