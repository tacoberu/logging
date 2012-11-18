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

namespace Taco\Utils\Logging\Filters;



/**
 *	Filter, který určuje, zda se bude zadaná informace logovat.
 *
 *	@author     Martin Takáč <taco@taco-beru.name>
 */
interface IFilter
{

	/**
	 * Všechny typy logu.
	 */
	const ALL = '*';



	/**
	 * Rozhoduje, zda tuto informaci budeme logovat.
	 *
	 * @return boolean
	 */
	function filter($level, $type = IFilter::ALL);


}
