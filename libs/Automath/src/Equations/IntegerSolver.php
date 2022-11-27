<?php
namespace Automath\Equations;

abstract class IntegerSolver implements \Automath\ISolver
{
	protected \Automath\IProblem $problem;

	public function __construct(\Automath\IProblem $problem)
	{
		$this->problem = $problem;
	}
	
	abstract public function solve();
}