<?php
namespace Automath;

/**
 * An instigator creates a problem
 * 
 */
interface IInstigator
{
	public function create() : IProblem;
}