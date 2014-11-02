<?php namespace MightyPork\Wrack;

/**
 * Base exception for custom exceptions
 */
class BaseException extends \Exception
{
	/**
	 * Create from (Cause), or (Message, [Cause]).
	 * Cause is Exception.
	 */
	public function __construct($arg1 = null, $arg2 = null, $arg3 = 0)
	{
		$cause = null;
		$message = "";
		$code = 0;

		if($arg1 instanceof Exception) {
			$cause = $arg1;

			if(is_int($arg2))
				$code = $arg2;

		} elseif(is_int($arg1)) {
			$code = $arg1;

			if(is_string($arg2))
				$message = $arg2;

		} elseif(is_string($arg1)) {
			$message = $arg1;

			if($arg2 instanceof Exception) {
				$cause = $arg2;

				if(is_int($arg3))
					$code = $arg2;

			} elseif(is_int($arg2))
				$code = $arg2;
		}

		parent::__construct($message, $code, $cause);
	}
}
