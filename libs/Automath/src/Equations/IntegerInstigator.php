<?php
namespace Automath\Equations;

class IntegerInstigator implements \Automath\IInstigator
{
	protected array $range;

	public function __construct(array $aRange, array $bRange)
	{
		// Check if types match, we expect variables a and b.
		if(count($aRange) !== 2 || count($bRange) !== 2)
		{
			throw new \TypeError('expecting min and max range for a and b');
		}

		$this->range = [ 'a' => $aRange, 'b' => $bRange ];
	}
	
	public function create() : \Automath\IProblem
	{
		$a = rand(min($this->range['a']), max($this->range['a']));
		$b = rand(min($this->range['b']), max($this->range['b']));

		return new IntegerProblem([ 'a' => $a, 'b' => $b ]);
	}
}