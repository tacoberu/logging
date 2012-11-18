<?php

/**
 * Description of Client of http
 *
 * PHP version 5.3
 *
 * @author	 Martin Takáč <taco@taco-beru.name>
 * @copyright  Copyright (c) 2010 Martin Takáč
 */

namespace Taco\Utils\Logging;





/**
 *	Požadavek na data serveru.
 *
 *	@author	 Martin Takáč <taco@taco-beru.name>
 */
class Log
{

	const TRACE = 7;
	const DEBUG = 6;
	const LOG = 5;
	const INFO = 4;
	const WARN = 3;
	const ERROR = 2;
	const FATAL = 1;


	/**
	 * Odpěratelé logů.
	 */
	private $listener = array();



	/**
	 *	Přiřadí writer, do kterého se bude zapisovat.
	 *
	 *	@return self
	 */
	public function addWriter(IWriter $writer, IFilter $filter)
	{
		$this->listener[] = (object)array(
				'writer' => $writer,
				'filter' => $filter,
				);
		return $this;
	}



	/**
	 *	Zda toto logovat.
	 *
	 *	@return bool
	 */
	public function logged($type = Null, $level = self::LOG)
	{
		foreach ($this->listener as $node) {
			if ($node->filter->filter($level, $type)) {
				return true;
			}
		}
		return false;
	}



	/**
	 *	Zaloguje
	 *
	 *	@return self
	 */
	public function log($message, $level = self::LOG, $type = Null)
	{
		foreach ($this->listener as $node) {
			if ($node->filter->filter($level, $type)) {
				$node->writer->write($message, $level, $type);
			}
		}
		return $this;
	}



	/**
	 *	Zaloguje pro level TRACE
	 *
	 *	@return self
	 */
	public function trace($message, $type = Null)
	{
		return $this->log($message, $level = self::TRACE, $type);
	}



	/**
	 *	Zaloguje pro level DEBUG
	 *
	 *	@return self
	 */
	public function debug($message, $type = Null)
	{
		return $this->log($message, $level = self::DEBUG, $type);
	}



	/**
	 *	Zaloguje pro level INFO
	 *
	 *	@return self
	 */
	public function info($message, $type = Null)
	{
		return $this->log($message, $level = self::INFO, $type);
	}



	/**
	 *	Zaloguje pro level WARN
	 *
	 *	@return self
	 */
	public function warn($message, $type = Null)
	{
		return $this->log($message, $level = self::WARN, $type);
	}



	/**
	 *	Zaloguje pro level ERROR
	 *
	 *	@return self
	 */
	public function error($message, $type = Null)
	{
		return $this->log($message, $level = self::ERROR, $type);
	}



	/**
	 *	Zaloguje pro level FATAL
	 *
	 *	@return self
	 */
	public function fatal($message, $type = Null)
	{
		return $this->log($message, $level = self::FATAL, $type);
	}



	/**
	 *	Vrátí sub logger za účelem zanoření.
	 *
	 *	@return
	 */
	public function getSubLog($name)
	{
	}



}
