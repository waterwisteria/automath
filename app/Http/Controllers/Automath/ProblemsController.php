<?php
namespace App\Http\Controllers\Automath;

use Illuminate\Http\Request;

class ProblemsController extends \App\Http\Controllers\Controller
{
	public function home()
	{
		$integerInstigator = new \Automath\Equations\IntegerInstigator();
		$integerInstigator->setProblemParameter('aRange', [ 0, 10 ]);
		$integerInstigator->setProblemParameter('bRange', [ 0, 10 ]);
		$integerInstigator->setProblemParameter('biggestTermFirst', false);
		$integerProblem = $integerInstigator->create();

		$integerSolver = new \Automath\Equations\Substraction\Solver();
		$integerSolver->setProblem($integerProblem);
		
		dump($integerProblem);
		dump($integerSolver->getSolution());
		
		//return view('automath/problem');
	}
}