<?php
namespace Automath;

/**
 * Mathematical problem
 * 
 */
interface IProblem
{
	public function __construct(array $vars);

	public function get(string $variable);
}