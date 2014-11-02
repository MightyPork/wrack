<?php namespace MightyPork\Wrack;

abstract class Renderer
{
	/**
	 * Get if this renderer can render the given mime type article
	 */
	public abstract function acceptsMime($mime);


	/**
	 * Get if the renderer can render the given extension article (*.md -> md)
	 */
	public abstract function acceptsExt($ext);


	/* override */
	public final function render($body)
	{
		$ra = $this->do_render($body);

		$text = $ra->body;

		// shift headings
		$text = Util::shiftHeadings($text, 1);

		// extract styles and scripts

		$text = preg_replace_callback('#(<script.*?>.*?</script>)#is', function($match) use($ra) {
			$ra->head .= $match[1]."\n";
			return '';
		}, $text);


		$text = preg_replace_callback('#(<style.*?>.*?</style>)#is', function($match) use($ra) {
			$ra->head .= $match[1]."\n";
			return '';
		}, $text);


		$text = preg_replace_callback('#(<link .*?>)#is', function($match) use($ra) {
			$ra->head .= $match[1]."\n";
			return '';
		}, $text);


		$text = preg_replace_callback('#(<pre><code.*?>)(.*?)(</code></pre>)#is', function($match) {

			$code = '';
			foreach(explode("\n", $match[2]) as $line) {
				$tabs = '';
				while(strpos($line, '    ') === 0) {
					$tabs .= "\t";
					$line = substr($line, 4);
				}
				$code .= "$tabs$line\n";
			}

			return $match[1] . rtrim($code) . $match[3];
		}, $text);

		$text = preg_replace('#<p>\s*</p>#is', '', $text);
		$text = preg_replace('#(<pre><code.*?>)<br />#is', '\1', $text);

		if (strpos($text,'<pre>') !== false) {
			$ra->head .= '<link rel="stylesheet" href="/css/highlight/googlecode.css">' . "\n";
			$ra->head .= '<script src="/js/highlight.pack.js"></script>' . "\n";
			$ra->head .= '<script>hljs.initHighlightingOnLoad();</script>' . "\n";
		}


		$ra->body = $text;

		return $ra;
	}


	protected abstract function do_render($body);
}
