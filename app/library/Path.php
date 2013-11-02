<?php namespace Sadeghi85;

class Path {
	
	static function getMarkdownRelativePath($main_tag, $slug)
	{
		return strtolower($main_tag.'/'.$slug);
	}

	static function getMarkdownAbsolutePath($main_tag, $slug)
	{
		return strtolower(app_path('markdown/'.static::getMarkdownRelativePath($main_tag, $slug).'.md'));
	}

	static function getMarkdownAbsoluteFolderPath($main_tag)
	{
		return strtolower(app_path('markdown/'.$main_tag));

	}
}