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
abstract class Base implements IWriter
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
	 * Definice podmínky.
	 */
	public function __construct($formating = '%message%', $sepparator = PHP_EOL)
	{
		$this->formating = $formating;
		$this->sepparator = $sepparator;
	}



	/**
	 *	Naformátuje zprávu.
	 *
	 *	@return self
	 */
	protected function format($message, $level = Log::INFO, $type = IFilter::ALL)
	{
		// Pokud takovouto informaci požadujeme.
		if ((strpos($this->formating, '%class%') !== False)
				|| (strpos($this->formating, '%method%') !== False)
				|| (strpos($this->formating, '%line%') !== False)) {
			if (PHP_MAJOR_VERSION >= 5 && PHP_MINOR_VERSION >= 4) {
				$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 4);
			}
			elseif (PHP_MAJOR_VERSION >= 5 && PHP_MINOR_VERSION >= 3 && PHP_RELEASE_VERSION >= 6) {
				$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			}
			else {
				$trace = debug_backtrace();
			}

			$class = $trace[3]['class'];
			$method = $trace[3]['function'];
			$line = $trace[2]['line'];
			$trace = Null; unset($trace);

			$placeholders = array(
					'%message%' => $message,
					'%level%' => self::formatLevel($level),
					'%type%' => $type,
					'%datetime%' => date('Y-m-d H:i:s'),
					'%class%' => $class,
					'%method%' => $method,
					'%line%' => $line,
					);
		}
		else {
			$placeholders = array(
					'%message%' => $message,
					'%level%' => self::formatLevel($level),
					'%type%' => $type,
					'%datetime%' => date('Y-m-d H:i:s')
					);
		}

		return strtr($this->formating, $placeholders) . $this->sepparator;;
	}



	/**
	 *	int to string
	 */
	private static function formatLevel($level)
	{
		return self::$levelNames[$level];
	}

}
