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
	public static function shortDate(Carbon $date, bool $lowerCase = false) : string
	{
		$formatedDate = $date->isoFormat('ll');

		if($lowerCase)
		{
			$formatedDate = strtolower($formatedDate);
		}
		
		return substr($formatedDate, 0, strlen($formatedDate) - 6);
	}
	
	public static function AutomathInclude(string $class, string $action, string $modifier = '')
	{
		return Str::replace('\\', '/', $class) . ucfirst($action) . ucfirst($modifier);
	}
}