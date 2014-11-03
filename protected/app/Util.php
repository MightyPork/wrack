<?php namespace MightyPork\Wrack;

class Util
{
	public static function fixPath($path)
	{
		return preg_replace('#/+#', '/', "$path");
	}

	public static function fixAbsPath($path)
	{
		return preg_replace('#/+#', '/', "/$path");
	}

	public static function arrayGet($array, $index)
	{
		if(isset($array[$index]))
			return $array[$index];
		else
			throw new StructureException("No such property: $index");
	}


	public static function arrayGetOptional($array, $index, $default = null)
	{
		if(isset($array[$index]))
			return $array[$index];
		else
			return $default;
	}


	/**
	 * Shift headings in html
	 */
	public static function shiftHeadings($html, $offset)
	{
		$replaceTable = array();
		$cleanupTable = array();
		for($i=1; $i<=6; $i++) {
			$cleanupTable[ '{{{h' . $i . '}}}' ] = '<h' . $i . '>';
			$cleanupTable[ '{{{/h' . $i . '}}}' ] = '</h' . $i . '>';

			if($i+$offset > 6 || $i+$offset < 1) continue;

			$replaceTable[ '<h' . $i . '>' ] = '{{{h' . ($i+$offset) . '}}}';
			$replaceTable[ '</h' . $i . '>' ] = '{{{/h' . ($i+$offset) . '}}}';
		}

		$html = self::strReplaceKV($replaceTable, $html);
		$html = self::strReplaceKV($cleanupTable, $html);

		return $html;
	}


	/**
	 * Batch preg replace array keys->values
	 */
	public static function pregReplaceKV($replaceTable, $text)
	{
		return preg_replace(array_keys($replaceTable), array_values($replaceTable), $text);
	}


	/**
	 * Batch str replace with array keys->values
	 */
	public static function strReplaceKV($replaceTable, $text)
	{
		return str_replace(array_keys($replaceTable), array_values($replaceTable), $text);
	}
}
