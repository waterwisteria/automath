<?php
namespace App\Quiz;
use Illuminate\Support\Str;

class BladeHelper
{
	public static function AutomathInclude(string $class, string $action, string $modifier = '')
	{
		return Str::replace('\\', '/', $class) . ucfirst($action) . ucfirst($modifier);
	}
}