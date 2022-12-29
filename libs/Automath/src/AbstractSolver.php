<?php
namespace Automath;
//use Automath\Problem;
use Automath\Equations\Solution;	

abstract class AbstractSolver implements \Automath\Solver
{
	use \Automath\VariableStoreTrait;

	/*
	 * Given problem
	 * 
	 */
	protected Problem $problem;

	/*
	 * Actual solution
	 * 
	 */
	protected Solution $solved;

	public function setProblem(Problem $problem) : void
	{
		$this->problem = $problem;
	}

	public function getProblem() : Problem
	{
		return $this->problem;
	}

	public function getSolution() : Solution
	{
		if(!$this->isSolved())
		{
			$this->solve();
		}
		
		return $this->solved;
	}

	public function grade(Solution $studentSolution) : int
	{
		if(!$this->isSolved())
		{
			$this->solve();
		}

		if(is_null($studentSolution->get('x')))
		{
			throw new \TypeError('Solution incomplete: missing variable x');
		}

		if($studentSolution->get('x') === $this->solved->get('x'))
		{
			return 1;
		}

		return 0;
	}

	public function isSolved() : bool
	{
		return !empty($this->solved);
	}

	public function solutionFromInput($input) : Solution
	{
		// It's been validated already, just cast it as string
		$solution = new Solution();
		$solution->set('x', (int) $input);

		return $solution;
	}
	
	abstract public function solve() : void;
}