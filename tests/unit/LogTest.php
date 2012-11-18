<?php

/**
 * Copyright (c) 2004, 2011 Martin Takáč
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
 */


require_once __dir__ . '/../../lib/Taco/Utils/Logging/IWriter.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/IFilter.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/Log.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/Filter.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/OutputWriter.php';


use Taco\Utils\Logging;


/**
 * @call phpunit Tests_Unit_Taco_Utils_Logging_LogTest LogTest.php
 */
class Tests_Unit_Taco_Utils_Logging_LogTest extends PHPUnit_Framework_TestCase
{



	/**
	 *	Nelogujeme nic.
	 */
	public function testEmpty()
	{
		$logger = new Logging\Log();
		ob_start();
		$logger->log('Lorem ipsum doler ist.');
		$content = ob_get_contents();
		ob_end_clean();
		$this->assertEquals($content, '');
	}



	/**
	 *	Nelogujeme nic.
	 */
	public function testEmptyLogged()
	{
		$logger = new Logging\Log();
		$this->assertFalse($logger->logged());
	}



	/**
	 *	Wirrer
	 */
	public function testFilterEmpty()
	{
		$logger = new Logging\Log();
		$logger->addWriter(new Logging\OutputWriter(), new Logging\Filter(Logging\Log::INFO, 'foo'));
		$this->assertFalse($logger->logged());
		ob_start();
		$logger->log('Lorem ipsum doler ist.');
		$content = ob_get_contents();
		ob_end_clean();
		$this->assertEquals($content, '');
	}



	/**
	 *	Shodat level a type.
	 */
	public function testFilterDefault()
	{
		$logger = new Logging\Log();
		$logger->addWriter(new Logging\OutputWriter(), new Logging\Filter(Logging\Log::INFO, 'foo'));
		$this->assertFalse($logger->logged());
		$this->assertFalse($logger->logged('foo'));
		$this->assertTrue($logger->logged('foo', Logging\Log::INFO));
		ob_start();
		$logger->log('Lorem ipsum doler ist.', Logging\Log::INFO, 'foo');
		$content = ob_get_contents();
		ob_end_clean();
		$this->assertEquals($content, 'Lorem ipsum doler ist.' . PHP_EOL);
	}



	/**
	 *	Wirrer
	 */
	public function testFilterDefaultNotMatch()
	{
		$logger = new Logging\Log();
		$logger->addWriter(new Logging\OutputWriter(), new Logging\Filter(Logging\Log::INFO, 'foo'));
		ob_start();
		$logger->log('Lorem ipsum doler ist.', Logging\Log::INFO, 'boo');
		$content = ob_get_contents();
		ob_end_clean();
		$this->assertEquals($content, '');
	}


	/**
	 *	Wirrer
	 */
	public function testFilterDefaultMultiple()
	{
		$logger = new Logging\Log();
		$logger->addWriter(new Logging\OutputWriter(), new Logging\Filter(Logging\Log::INFO, 'foo'));
		ob_start();
		$logger->log('Jedna.', Logging\Log::INFO, 'foo');
		$logger->log('Dva.', Logging\Log::ERROR, 'foo');
		$logger->log('Tri.', Logging\Log::INFO, 'foo');
		$content = ob_get_contents();
		ob_end_clean();
		$this->assertEquals($content, "Jedna.\nDva.\nTri.\n");
	}




	/**
	 *	Logovat tři hodnoty, ale pouze dvě zapsat.
	 */
	public function testFilterMultipleMathced()
	{
		$logger = new Logging\Log();
		$logger->addWriter(new Logging\OutputWriter(), new Logging\Filter(Logging\Log::INFO, 'foo'));
		ob_start();
		$logger->log('Jedna.', Logging\Log::INFO, 'foo');
		$logger->log('Dva.', Logging\Log::ERROR, 'doo');
		$logger->log('Tri.', Logging\Log::INFO, 'foo');
		$content = ob_get_contents();
		ob_end_clean();
		$this->assertEquals($content, "Jedna.\nTri.\n");
	}




}
