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
class OutputWriter implements IWriter
{

	/**
	 * Překladovaá maska.
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
	 * Definice podmínky.
	 */
	public function __construct($formating = '%message%', $sepparator = PHP_EOL)
	{
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
		echo strtr($this->formating, array(
				'%message%' => $message,
				'%level%' => self::formatLevel($level),
				'%type%' => $type,
				'%datetime%' => date('Y-m-d H:i:s'),
				)) . $this->sepparator;
	}


	/**
	 *	int to string
	 */
	private static function formatLevel($level)
	{
		return self::$levelNames[$level];
	}

}
