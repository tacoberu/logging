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


use Taco\Utils\Logging\Filters\IFilter;



/**
 *	Uložiště, do kterého se budou zapisovat logy.
 *
 *	@author     Martin Takáč <taco@taco-beru.name>
 */
interface IWriter
{


	/**
	 *	Zaloguje zprávu.
	 *
	 *	@return self
	 */
	function write($message, $level = Log::INFO, $type = IFilter::ALL);


}
