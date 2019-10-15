<?php

namespace G3T\Press\Tests;

use Orchestra\Testbench\TestCase;

use G3T\Press\MarkdownParser;

class MarkdownTest extends TestCase
{
	/** @test */
	public function simple_markdown_is_parsed()
	{

		//preg_match('/^\-{3}(.*?)\-{3}(.*)/s', $input_lines, $output_array);
		$this->assertEquals('<h1>Heading</h1>', MarkdownParser::parse('# Heading'));
		
	}
	
}

