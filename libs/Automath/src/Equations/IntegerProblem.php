<?php
namespace Automath\Equations;

class IntegerProblem implements \Automath\IProblem
{
	protected array $variables;
	
	public function __construct(array $vars)
	{
		// Check if types match, we expect variables a and b.
		if(isset($vars['a']) && isset($vars['b']) &&
		is_int($vars['a']) && is_int($vars['b']))
		{
			$this->variables['a'] = $vars['a'];
			$this->variables['b'] = $vars['b'];
		}

		else
		{
			throw new \TypeError('integers expected');
		}
	}

	public function get(string $variable)
	{
		return $this->variables[$variable];
	}
}