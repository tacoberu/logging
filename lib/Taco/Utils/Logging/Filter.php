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
	 */
	public function __construct($level = Log::INFO, $type = self::ALL)
	{
		$this->level = $level;
		$this->type = $type;
	}



	/**
	 * Zda toto zalogujeme.
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
