<?php
namespace App\Quiz;
use App\Models\Problem;
use App\Models\Quiz;
use App\Models\QuizEntry;
use App\Models\User;
use TypeError;
use App\Enums\QuizStatus;
use App\Http\Controllers\QuizController;

/**
 * A quizz generates a bunch of problems and solutions.
 * 
 */
class Generator
{
	protected array $problems = [ ];
	protected User $user;
	protected Quiz $quiz;
	
	public function __construct(User $user, string $title)
	{
		$this->user = $user;

		$this->quiz = new Quiz();
		$this->quiz->user_id = $this->user->id;
		$this->quiz->title = $title;
		$this->quiz->status = QuizStatus::Inprogress;
		$this->quiz->save();
	}

	public function getQuizEntries() : array
	{
		return $this->problems;
	}

	public function getQuiz() : Quiz
	{
		return $this->quiz;
	}
	
	
	public function addProblemsRandomSolution(Problem $problem, int $amount) : void
	{
		for($i = 1; $i <= $amount; $i++)
		{
			$this->problems[] = self::generateRandomQuizEntry($this->quiz, $problem);
		}
	}

	/**
	* Generate a problem with a random solution.
	*
	*/
	public static function generateRandomQuizEntry(Quiz $quiz, Problem $problem) : QuizEntry
	{
		$instigator = self::generateInstigator($problem);

		$quizEntry = new QuizEntry();
		$quizEntry->quiz_id = $quiz->id;
		$quizEntry->problem_id = $problem->id;
		$quizEntry->vars = $instigator->create()->getProblemVariables();
		$quizEntry->solution = null;
		$quizEntry->score = null;
		$quizEntry->save();

		return $quizEntry;
	}

	/**
	 * Generate a concrete random problem.
	 * 
	 * @param Problem $problem
	 * @return \AutoMath\Problem $problem
	 * 
	 */
	public static function generateInstigator(Problem $problem) : \AutoMath\Instigator
	{
		if(!class_exists($problem->problemDefinition->instigator))
		{
			// @TODO Create domain type exception
			throw new TypeError("Instigator class \'{$problem->problemDefinition->instigator}\' does not exists");
		}

		$instigator = new ($problem->problemDefinition->instigator);

		foreach($problem->instigator_params as $k => $param)
		{
			$instigator->setProblemParameter($k, $param);
		}
		
		return $instigator;
	}
}