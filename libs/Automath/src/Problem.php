<?php
namespace Automath;

/**
 * A problem
 * 
 */
interface Problem extends \JsonSerializable
{
	public function jsonSerialize();
}