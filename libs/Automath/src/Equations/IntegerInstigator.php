<?php
namespace Automath\Equations;
use TypeError;

class IntegerInstigator implements \Automath\Instigator
{
	protected array $parameters = [ 'aRange' => null, 'bRange' => null, 'biggestTermFirst' => false ];

	public function setProblemParameter(string $paramName, $value) : void
	{
		if(!key_exists($paramName, $this->parameters))
		{
			throw new \TypeError('Problem parameters are aRange and bRange');
		}

		$this->parameters[$paramName] = $value;
	}

	public function create() : \Automath\Problem
	{
		$problem = new IntegerProblem();
		$a = rand(min($this->parameters['aRange']), max($this->parameters['aRange']));
		$b = rand(min($this->parameters['bRange']), max($this->parameters['bRange']));

		// Swap vars if b is bigger, for always positive substraction.
		if($this->parameters['biggestTermFirst'] && $a < $b)
		{
			$t = $a;
			$a = $b;
			$b = $t;
		}
		
		$problem->set('a', $a);
		$problem->set('b', $b);

		return $problem;
	}
}