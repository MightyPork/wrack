<?php namespace MightyPork\Wrack;

class Util
{
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
}
