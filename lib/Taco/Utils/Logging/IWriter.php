<?php

/**
 * Description of Client of http
 *
 * PHP version 5.3
 *
 * @author     Martin Takáč <taco@taco-beru.name>
 * @copyright  Copyright (c) 2010 Martin Takáč
 */

namespace Taco\Utils\Logging;



/**
 *	Jednoduchý klient pro komunikaci s http serverem.
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
