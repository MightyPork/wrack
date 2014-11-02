<?php namespace MightyPork\Wrack;

/**
 * Utility for profiling.
 */
class Profiler
{
	/**
	 * Get current time
	 */
	public static function now()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}


	/**
	 * Start profiling
	 *
	 * @return current time (profiling token)
	 */
	public static function start()
	{
		return self::now();
	}


	/**
	 * Measure time elapsed since start
	 *
	 * @param $start ... time obtained with "start()"
	 *
	 * @return time elapsed (s)
	 */
	public static function end($start)
	{
		return sprintf('%0.3f', self::now() - $start);
	}
}
