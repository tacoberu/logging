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

namespace Taco\Utils\Logging\Writers;


use Taco\Utils\Logging\Log,
	Taco\Utils\Logging\Filters\IFilter;



/**
 *	Logy budem vypisovat rovnou na výstup.
 *
 *	@author     Martin Takáč <taco@taco-beru.name>
 */
class File extends Base
{

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
		parent::__construct($formating, $sepparator);
	}



	/**
	 *	Zaloguje zprávu.
	 *
	 *	@return self
	 */
	public function write($message, $level = Log::INFO, $type = IFilter::ALL)
	{
		$content = $this->format($message, $level, $type);
		$handle = fopen($this->filename, "a");
		fwrite($handle, $content);
		fclose($handle);
	}


}
