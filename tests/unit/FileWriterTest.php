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
require_once __dir__ . '/../../lib/Taco/Utils/Logging/Filters/IFilter.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/Writers/File.php';
require_once __dir__ . '/../../lib/Taco/Utils/Logging/Log.php';



use Taco\Utils\Logging,
	org\bovigo\vfs\vfsStream;


/**
 * @call phpunit --bootstrap ../bootstrap.php Tests_Unit_Taco_Utils_Logging_FileWriterTest FileWriterTest.php
 */
class Tests_Unit_Taco_Utils_Logging_FileWriterTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var  vfsStreamDirectory
	 */
	private $root;


	protected function setUp()
	{
		$this->root = vfsStream::setup("logs");
	}


	/**
	 *	Wirrer
	 */
	public function testFilterDefault()
	{
		$writer = new Logging\FileWriter(vfsStream::url("logs") . '/log.txt');
		$writer->write('Lorem ipsum doler ist.');
		$writer->write('Lorem wagnum.');

		$logFile = $this->root->getChild("log.txt");
		$this->assertEquals("Lorem ipsum doler ist.\nLorem wagnum.\n", $logFile->getContent());
	}



	/**
	 *	Formátování výstupu.
	 */
	public function testWriterFormating()
	{
		$writer = new Logging\FileWriter(vfsStream::url("logs") . '/log.txt', "%datetime% - %message%");
		$writer->write('Lorem ipsum doler ist.');
		$writer->write('Lorem wagnum.');

		$now = new \DateTime();
		$logFile = $this->root->getChild("log.txt");
		$this->assertEquals(
				$now->format('Y-m-d H:i:s') . " - Lorem ipsum doler ist.\n" .
				$now->format('Y-m-d H:i:s') . " - Lorem wagnum.\n", $logFile->getContent());
	}



	/**
	 *	Formátování výstupu.
	 */
	public function testWriterFormatingWithAll()
	{
		$writer = new Logging\FileWriter(vfsStream::url("logs") . '/log.txt', "%datetime% - [%level%] - [%type%] - %message%");
		$writer->write('Lorem ipsum doler ist.');
		$writer->write('Lorem wagnum.');

		$now = new \DateTime();
		$logFile = $this->root->getChild("log.txt");
		$this->assertEquals(
				$now->format('Y-m-d H:i:s') . " - [INFO ] - [*] - Lorem ipsum doler ist.\n" .
				$now->format('Y-m-d H:i:s') . " - [INFO ] - [*] - Lorem wagnum.\n", $logFile->getContent());
	}



}
