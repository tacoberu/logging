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
interface IFilter
{

	const ALL = '*';



	/**
	 * Zda toto zalogujeme.
	 * @return boolean
	 */
	function filter($level, $type = IFilter::ALL);


}
