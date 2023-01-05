<?php
namespace App\Quiz;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class BladeHelper
{
	/**
	 * Translated *and* localised short date.
	 * 
	 * @param mixed $date
	 * 
	 * @return string
	 * 
	 */
	public static function shortDate(Carbon $date) : string
	{
		$formatedDate = $date->isoFormat('ll');

		return substr($formatedDate, 0, strlen($formatedDate) - 6);
	}
	
	public static function AutomathInclude(string $class, string $action, string $modifier = '')
	{
		return Str::replace('\\', '/', $class) . ucfirst($action) . ucfirst($modifier);
	}
}