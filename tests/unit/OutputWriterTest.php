<?php

/**
 * Copyright (c) 2004, 2012 Martin Takáč
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @author     Martin Takáč <taco@taco-beru.name>
 *
 * PHP version 5.3
 */


require_once __dir__ . '/../../lib/Taco/Utils/Logging/Writers/IWriter.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/Writers/Output.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/Log.php';


use Taco\Utils\Logging;


/**
 * @call phpunit Tests_Unit_Taco_Utils_Logging_OutputWriterTest OutputWriterTest.php
 */
class Tests_Unit_Taco_Utils_Logging_OutputWriterTest extends PHPUnit_Framework_TestCase
{



	/**
	 *	Wirrer
	 */
	public function testFilterDefault()
	{
		$writer = new Logging\OutputWriter();
		ob_start();
		$writer->write('Lorem ipsum doler ist.');
		$content = ob_get_contents();
		ob_end_clean();
		$this->assertEquals($content, 'Lorem ipsum doler ist.' . PHP_EOL);
	}



	/**
	 *	Formátování výstupu.
	 */
	public function testWriterFormating()
	{
		$writer = new Logging\OutputWriter("%datetime% - %message%");
		ob_start();
		$writer->write('Lorem ipsum doler ist.');
		$content = ob_get_contents();
		ob_end_clean();
		$this->assertEquals($content, date('Y-m-d H:i:s') . ' - Lorem ipsum doler ist.' . PHP_EOL);
	}



	/**
	 *	Formátování výstupu.
	 */
	public function testWriterFormatingWithAll()
	{
		$writer = new Logging\OutputWriter("%datetime% - [%level%] - [%type%] - %message%");
		ob_start();
		$writer->write('Lorem ipsum doler ist.');
		$content = ob_get_contents();
		ob_end_clean();
		$this->assertEquals($content, date('Y-m-d H:i:s') . ' - [INFO ] - [*] - Lorem ipsum doler ist.' . PHP_EOL);
	}



}
