<?php namespace MightyPork\Wrack;

interface IRenderer
{
	/**
	 * Get if this renderer can render the given mime type article
	 */
	function acceptsMime($mime);


	/**
	 * Get if the renderer can render the given extension article (*.md -> md)
	 */
	function acceptsExt($ext);


	/**
	 * Render an article
	 */
	function render($body);
}
