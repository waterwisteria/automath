<?php
namespace App\Quiz;
use App\Models\Quiz;
use Illuminate\Http\Request;

class TimeSpentService
{
	/**
	* At what time the quiz was started.
	*
	*/
	public const QUIZ_START_TIME = 'quiz_start_time';

	/**
	 * Store quiz start time in session. If present already blank
	 * it out, previous quiz was abandoned.
	 * 
	 * @param Request $request
	 * 
	 */
	public function start(Request $request)
	{
		$request->session()->put(self::QUIZ_START_TIME, time());
	}

	/**
	 * Compute time spent from quiz start time and store it in model then
	 * reset timer.
	 * 
	 * @param Request $request
	 * @param Quiz $quiz
	 * 
	 * @return int $timeSpent
	 * 
	 */
	public function reset(Request $request, Quiz $quiz) : int
	{
		$timeSpent = time() - $request->session()->get(self::QUIZ_START_TIME, time());
		$quiz->time_spent += $timeSpent;
		
		$this->start($request);

		return $timeSpent;
	}
}