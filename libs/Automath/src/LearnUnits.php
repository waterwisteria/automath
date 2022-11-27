<?php
namespace Automath;

class LearnUnits
{
	public const PROBLEMS = [
		// Primary grade additions
		'ADDITION_SINGLE_DIGIT_TERMS' =>
		[
			'instigator'     => Automath\Equations\IntegerInstigator::class,
			'problem'        => Automath\Equations\IntegerProblem::class,
			'solver'         => Automath\Equations\Addition\Solver::class,
			'vars'           => [ 'a', 'b' ],
			'range'          => [ 'a' => [ 1, 9 ], 'b' => [ 1, 9 ] ],
			'targetProblems' => 10,
			'targetScore'    => 90,
			'targetTime'     => 600
		],
		'ADDITION_DOUBLE_DIGIT_TERMS' =>
		[
			'instigator'     => Automath\Equations\IntegerInstigator::class,
			'problem'        => Automath\Equations\IntegerProblem::class,
			'solver'         => Automath\Equations\Addition\Solver::class,
			'vars'           => [ 'a' => [ 1, 50 ], 'b' => [ 1, 50 ] ],
			'targetProblems' => 10,
			'targetScore'    => 90,
			'targetTime'     => 600
		]
	];
}