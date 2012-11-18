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


/*
 *	Test v podrizenenm adresari.
 */
//require_once __dir__ . '/app/Suite.php';


/*
 *	Testy v tomto adresari.
 */
require_once __dir__ . '/FilterTest.php';
require_once __dir__ . '/LogTest.php';
require_once __dir__ . '/OutputWriterTest.php';


/**
 * Hromadné testy.
 *
 * @call phpunit Suite.php Tests_Unit_Taco_Utils_Logging_Suite
 * @author Martin Takáč <taco@taco-beru.name>
 */
class Tests_Unit_Taco_Utils_Logging_Suite extends PHPUnit_Framework_TestSuite
{

	/**
	 * Ktere testy poustet,
	 *
	 * @return PHPUnit_Framework_TestSuite
	 */
	public static function suite()
	{
		$suite = new self('Vsechny testy/suite.');

		//	Testy v tomto adresari.
		$suite->addTestSuite('Tests_Unit_Taco_Utils_Logging_FilterTest');
		$suite->addTestSuite('Tests_Unit_Taco_Utils_Logging_LogTest');
		$suite->addTestSuite('Tests_Unit_Taco_Utils_Logging_OutputWriterTest');

		//	Test v podrizenenm adresari.
		//$suite->addTest(tests_app_Suite::suite());

		return $suite;
	}

}
