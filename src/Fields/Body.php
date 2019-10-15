<?php

namespace G3T\Press\Fields;

use G3T\Press\MarkdownParser;

class Body
{
	public static function process($type, $value)
	{
		return [
			$type => MarkdownParser::parse($value),
		];
	}
}

