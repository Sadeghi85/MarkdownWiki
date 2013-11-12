<?php namespace Sadeghi85;

class Utility {
	
	static function getAbstract($str)
	{
		$md = new \dflydev\markdown\MarkdownExtraParser();

		$str = $md->transformMarkdown(html_entity_decode($str, ENT_QUOTES, 'UTF-8'));

		preg_match_all('#<h\d>([^<>]+)</h\d>#i', $str, $hTags);

		$str = '';

		foreach ($hTags[1] as $value)
		{
			$str .= '* '.trim($value, ':')."\n";
		}
		
		return $md->transformMarkdown($str);
	}

	static function getSlug($id)
	{
		$oSlug = \SlugHistories::where('post_id', $id)->orderBy('id', 'desc')->select('slug')->first();

		return $oSlug->slug;
	}

	static function setSearchContent($str)
	{
		return preg_replace('#(?:^|\s)(\S{2,3})(?:\s|$)#iu', '\1__', $str);
	}


}