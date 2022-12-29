<?php
namespace Automath;
use Automath\Equations\Solution;

/**
 * A solver solves an Problem
 * 
 */
interface Solver
{
	/*
	 * Set the base problem
	 * 
	 */
	public function setProblem(Problem $problem) : void;

	/**
	 * Get the base problem
	 * 
	 * @return Problem
	 * 
	 */
	public function getProblem() : Problem;

	/**
	 * Actual solution to the problem.
	 * 
	 * @param array $proposedSolution
	 * 
	 * @return Solution
	 * 
	 */
	public function getSolution() : Solution;

	/**
	 * Grade provided solution.
	 * 
	 * @param Solution $studentSolution
	 * 
	 */
	public function grade(Solution $studentSolution) : int;

	/**
	 * Total points for the problem.
	 * 
	 * @return int
	 * 
	 */
	public function totalPoints() : int;

	/**
	 * Instantiate the proper solution from input
	 * 
	 * @param mixed $input
	 * 
	 * @return Solution
	 * 
	 */
	public function solutionFromInput($input) : Solution;
}