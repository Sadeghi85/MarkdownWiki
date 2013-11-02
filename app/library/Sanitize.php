<?php namespace Sadeghi85;

class Sanitize {
	
	static function title($str)
	{
		return preg_replace('#[^\p{N}\p{L}\p{M}\p{S}\p{P} ]+#u', '', e($str));
	}

	static function alias($str)
	{
		if ( ! preg_match('#^[\p{N}\p{L}\p{M}\p{S}\p{P} ]+$#u', $str))
		{
			return null;
		}

		return trim(preg_replace('#-+#', '-', preg_replace('#[^\p{N}\p{L}\p{S}]+#u', '-', mb_strtolower($str, 'UTF-8'))), '-');
	}

	static function content($str)
	{
		return e($str);
	}

	static function tag($str)
	{
		return static::alias($str);
	}
}