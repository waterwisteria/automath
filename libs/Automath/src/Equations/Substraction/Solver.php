<?php
namespace Automath\Equations\Substraction;
use Automath\Equations\Solution;

class Solver extends \Automath\AbstractSolver
{
	public function solve() : void	
	{
		if(is_null($this->problem->get('a')) || is_null($this->problem->get('b')))
		{
			throw new \TypeError('Missing variable(s) a or b');
		}
		
		$this->solved = new Solution();
		$this->solved->set('x', $this->problem->get('a') - $this->problem->get('b'));
	}

	public function totalPoints() : int
	{
		return 1;
	}
}