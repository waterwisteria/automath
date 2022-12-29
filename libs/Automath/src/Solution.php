<?php
namespace AutoMath;

interface Solution extends \JsonSerializable
{
	public function jsonSerialize();
}