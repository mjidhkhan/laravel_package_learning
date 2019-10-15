<?php

namespace G3T\Press;

use Carbon\Carbon;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PressFileParser
{
	protected $filename;
	protected $rawdata;

	public function __construct($filename)
	{
		$this->filename = $filename;

		$this->splitFile();

		$this->explodeData();

		$this->processFields();
	}

	public function getData()
	{
		return $this->rawdata;

	}

	protected function splitFile()
	{
		
		preg_match('/^\-{3}(.*?)\-{3}(.*)/s', 
		File::exists($this->filename)?File::get($this->filename): $this->filename,
		$this->rawdata
		);	
		
		
	}

	protected function explodeData()
	{
		//dd(trim($this->rawdata[1]));
		foreach (explode("\n", trim($this->rawdata[1])) as $fieldString) {
			preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);
			$this->rawdata[$fieldArray[1]] = $fieldArray[2];
		}
		$this->rawdata['body'] = trim($this->rawdata[2]);

	}


	protected function processFields()
	{
		foreach ($this->rawdata as $field => $value) {
			
				$class = 'G3T\\Press\\Fields\\' . Str::title($field);
				if(class_exists($class) && \method_exists($class, 'process')){
					$this->rawdata= array_merge(
						$this->rawdata,
						$class::process($field, $value)
					);
				}
			
		}
	}
	
}

