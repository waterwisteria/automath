<?php
namespace Automath;

/**
 * A solver solves an IProblem
 * 
 */
interface ISolver
{
	public function __construct(IProblem $problem);
	public function solve();
}