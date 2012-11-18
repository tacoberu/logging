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

namespace Taco\Utils\Logging;



/**
 *	Logy budem vypisovat rovnou na výstup.
 *
 *	@author     Martin Takáč <taco@taco-beru.name>
 */
class FileWriter implements IWriter
{

	/**
	 * Překladová maska.
	 */
	private static $levelNames = array(
			Log::TRACE => 'TRACE',
			Log::DEBUG => 'DEBUG',
			Log::LOG =>   'LOG  ',
			Log::INFO =>  'INFO ',
			Log::WARN =>  'WARN ',
			Log::ERROR => 'ERROR',
			Log::FATAL => 'FATAL',
			);


	/**
	 * Maska výstupu.
	 */
	private $formating;


	/**
	 * Oddělovač řádek.
	 */
	private $sepparator;


	/**
	 * Soubor, do kterého se bude ukládat.
	 */
	private $filename;


	/**
	 * Definice podmínky.
	 */
	public function __construct($filename, $formating = '%message%', $sepparator = PHP_EOL)
	{
		if (empty($filename)) {
			throw new \InvalidArgumentException('Empty filename.');
		}
		$this->filename = $filename;
		$this->formating = $formating;
		$this->sepparator = $sepparator;
	}



	/**
	 *	Zaloguje zprávu.
	 *
	 *	@return self
	 */
	public function write($message, $level = Log::INFO, $type = IFilter::ALL)
	{
		$content = strtr($this->formating, array(
				'%message%' => $message,
				'%level%' => self::formatLevel($level),
				'%type%' => $type,
				'%datetime%' => date('Y-m-d H:i:s'),
				)) . $this->sepparator;
		$handle = fopen($this->filename, "a");
		fwrite($handle, $content);
		fclose($handle);
	}


	/**
	 *	int to string
	 */
	private static function formatLevel($level)
	{
		return self::$levelNames[$level];
	}

}
