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
 *	Filter, který určuje, zda se bude zadaná informace logovat.
 *
 *	@author     Martin Takáč <taco@taco-beru.name>
 */
class Filter implements IFilter
{


	/**
	 *	Uroven logování.
	 */
	private $level;


	/**
	 *	Typ logu. Maska.
	 */
	private $type;


	/**
	 * Definice podmínky.
	 *
	 * @param enum Uroveň závažnosti informace.
	 * @param string Značka skupiny. Typ logu. Maska
	 */
	public function __construct($level = Log::INFO, $type = self::ALL)
	{
		$this->level = $level;
		$this->type = $type;
	}



	/**
	 * Rozhoduje, zda tuto informaci budeme logovat.
	 *
	 * @return boolean
	 */
	public function filter($level, $type = self::ALL)
	{
		if ($this->type == self::ALL || $this->type == $type) {
			if ($level <= $this->level) {
				return True;
			}
		}
		return False;
	}


}
