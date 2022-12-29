<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizEntry;
use App\Models\User;
use App\Enums\QuizStatus;

class Quiz extends Model
{
	use HasFactory;
	
	protected ?float $finalScore = null;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function quizEntries()
	{
		return $this->hasMany(QuizEntry::class);
	}

	public function questionsAnswered() : int
	{
		$questionsAnswered = 0;
		
		foreach($this->quizEntries as $quizEntry)
		{
			if($quizEntry->solution !== null)
			{
				$questionsAnswered++;
			}
		}

		return $questionsAnswered;
	}

	public function percentCompleted() : float
	{
		$questionsAnswered = 0;
		$totalQuestions = $this->quizEntries->count();

		foreach($this->quizEntries as $quizEntry)
		{
			if($quizEntry->solution !== null)
			{
				$questionsAnswered++;
			}
		}

		return ($questionsAnswered / $totalQuestions) * 100;
	}

	public function close() : bool
	{
		$scoreSoFar = 0;
		$totalScore = 0;
		
		foreach($this->quizEntries as $quizEntry)
		{
			// All solutions must be provided in order to close the quiz
			if($quizEntry->solution === null)
			{
				return false;
			}

			$scoreSoFar += $quizEntry->score;
			$totalScore += $quizEntry->getSolver()->totalPoints();
		}

		$this->score = intval(($scoreSoFar / $totalScore) * 10000);
		$this->status = QuizStatus::Completed;

		return true;
	}

	/**
	 * Get final score in percentage
	 * 
	 * @return ?int 
	 */
	public function getFinalScore() : ?float
	{
		if($this->status === QuizStatus::Completed->value)
		{
			$this->finalScore = round($this->score / 100, 2);
		}

		return $this->finalScore;
	}
}