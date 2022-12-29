<?php
namespace Automath;

trait VariableStoreTrait
{
	protected array $variables;

	/**
	* Set a variable for the solution
	*
	* @param string $variable
	*
	*/
	public function set(string $variable, $value) : void
	{
		$this->variables[$variable] = $value;
	}

	public function get(string $variable, $default = null)
	{
		return $this->variables[$variable] ?? $default;
	}
	
	public function getProblemVariables() : array
	{
		return $this->variables;
	}

	public function jsonSerialize() : array
	{
		return $this->variables;
	}
}