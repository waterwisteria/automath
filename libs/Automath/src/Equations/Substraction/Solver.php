<?php
namespace Automath\Equations\Substraction;

class Solver extends Automath\Equations\IntegerSolver
{
	public function solve()
	{
		return $this->problem->get('a') - $this->problem->get('b');
	}
}