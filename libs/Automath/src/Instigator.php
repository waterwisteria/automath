<?php
namespace Automath;

/**
 * An instigator creates a problem
 * 
 */
interface Instigator
{
	/**
	 * Set a problem parameter, e.g: a variable range
	 * @param string $paramName
	 * @param mixed $value
	 * 
	 * @return void
	 * 
	 */
	public function setProblemParameter(string $paramName, $value) : void;

	/**
	 * Generate A problem given the problem parameters.
	 * 
	 * @return Problem
	 * 
	 */
	public function create() : Problem;
}