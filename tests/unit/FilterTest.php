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


require_once __dir__ . '/../../lib/Taco/Utils/Logging/IFilter.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/Filter.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/Log.php';


use Taco\Utils\Logging;


/**
 * @call phpunit Tests_Unit_Taco_Utils_Logging_FilterTest FilterTest.php
 */
class Tests_Unit_Taco_Utils_Logging_FilterTest extends PHPUnit_Framework_TestCase
{



	/**
	 *	Price
	 */
	public function testFilterDefault()
	{
		$filter = new Logging\Filter();
		$this->assertFalse($filter->filter(Logging\Log::TRACE));
		$this->assertFalse($filter->filter(Logging\Log::DEBUG));
		$this->assertTrue($filter->filter(Logging\Log::INFO));
		$this->assertTrue($filter->filter(Logging\Log::WARN));
		$this->assertTrue($filter->filter(Logging\Log::ERROR));
		$this->assertTrue($filter->filter(Logging\Log::FATAL));

		$this->assertFalse($filter->filter(Logging\Log::TRACE, 'foo'));
		$this->assertTrue($filter->filter(Logging\Log::FATAL, 'foo'));
	}



	/**
	 *	Všechny INFO víše s typem 'foo'
	 */
	public function testFilterTypeFoo()
	{
		$filter = new Logging\Filter(Logging\Log::INFO, 'foo');

		$this->assertFalse($filter->filter(Logging\Log::TRACE));
		$this->assertFalse($filter->filter(Logging\Log::DEBUG));
		$this->assertFalse($filter->filter(Logging\Log::INFO));
		$this->assertFalse($filter->filter(Logging\Log::WARN));
		$this->assertFalse($filter->filter(Logging\Log::ERROR));
		$this->assertFalse($filter->filter(Logging\Log::FATAL));

		$this->assertFalse($filter->filter(Logging\Log::TRACE, 'foo'));
		$this->assertFalse($filter->filter(Logging\Log::DEBUG, 'foo'));
		$this->assertTrue($filter->filter(Logging\Log::INFO, 'foo'));
		$this->assertTrue($filter->filter(Logging\Log::WARN, 'foo'));
		$this->assertTrue($filter->filter(Logging\Log::ERROR, 'foo'));
		$this->assertTrue($filter->filter(Logging\Log::FATAL, 'foo'));

		$this->assertFalse($filter->filter(Logging\Log::TRACE, 'boo'));
		$this->assertFalse($filter->filter(Logging\Log::DEBUG, 'boo'));
		$this->assertFalse($filter->filter(Logging\Log::INFO, 'boo'));
		$this->assertFalse($filter->filter(Logging\Log::WARN, 'boo'));
		$this->assertFalse($filter->filter(Logging\Log::ERROR, 'boo'));
		$this->assertFalse($filter->filter(Logging\Log::FATAL, 'boo'));
	}


}
