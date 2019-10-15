<?php

namespace G3T\Press;

use Parsedown;

class MarkdownParser
{
	public static function parse($string)
	{	
		return Parsedown::instance()->text($string);
	}
}

