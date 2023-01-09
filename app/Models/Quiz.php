<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizEntry;
use App\Models\User;
use App\Enums\QuizStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

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

	public function scopeUnansweredEntries() : Builder
	{
		return QuizEntry::where('quiz_id', $this->id)->whereNull('solution');
	}

	public function scopeAnsweredEntries() : Builder
	{
		return QuizEntry::where('quiz_id', $this->id)->whereNotNull('solution');
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

	/**
	 * Set quiz as completed if all questions are answered.
	 * 
	 * @return bool

	 */
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
	 * @return ?float
	 *
	 */
	public function getFinalScore(int $round = 2) : ?float
	{
		if($this->status === QuizStatus::Completed->value)
		{
			$this->finalScore = round($this->score / 100, $round);
		}

		return $this->finalScore;
	}

	public function gradeSolutions(array $solutions) : void
	{
		foreach($solutions as $quizEntryId => $solution)
		{
			// We allow not answering problems. They must be left empty,
			// the validator will return null for those cases. Everything
			// else gets graded and becomes immutable.
			if($solution !== null)
			{
				// Grade solution
				$quizEntry = QuizEntry::find($quizEntryId);
				$quizEntry->grade($solution);
				$quizEntry->save();
			}
		}
	}

	public static function scopeBestQuizzes(User $user) : Builder
	{
		return Quiz::scopeByUserState($user, QuizStatus::Completed)->orderBy('score', 'desc')->take(config('automath.best_quizzes_per_page'));
	}

	public static function scopePendingQuizzes(User $user, int $take = 5) : Builder
	{
		return Quiz::scopeByUserState($user, QuizStatus::Inprogress)->latest()->take($take);
	}

	/**
	 * Get by user AND (optionally) by quiz state.
	 * 
	 * @param User $user
	 * @param QuizStatus $quizStatus
	 * 
	 * @return Builder
	 * 
	 */
	public static function scopeByUserState(User $user, ?QuizStatus $quizStatus = null) : Builder
	{
		$builder = self::where('user_id', $user->id);

		if($quizStatus)
		{
			$builder->where('status', $quizStatus);
		}
		
		return $builder;
	}

	public static function scopeUserAnsweredQuestions(User $user) : Builder
	{
		return self::scopeByUserState($user)
			->join('quiz_entries', 'quizzes.id', '=', 'quiz_entries.quiz_id')
			->whereNotNull('quiz_entries.solution');
	}
}