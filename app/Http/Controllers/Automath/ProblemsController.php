<?php
namespace App\Http\Controllers\Automath;

use Illuminate\Http\Request;

class ProblemsController extends \App\Http\Controllers\Controller
{
	public function home()
	{
		$integerInstigator = new \Automath\Equations\Addition\IntegerInstigator([ 0, 10 ], [ 0, 10 ]);
		$integerProblem = $integerInstigator->create();
		$integerSolver = new \Automath\Equations\Addition\IntegerSolver($integerProblem);
		
		dump($integerProblem);
		dump($integerSolver->solve());
		
		return view('automath/problem');
	}
}