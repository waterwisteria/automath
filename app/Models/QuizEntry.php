<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\QuizStatus;
use App\Models\Problem;
use App\Models\Quiz;
use Automath\Problem as AutomathProblem;
use Automath\Solver;

class QuizEntry extends Model
{
    use HasFactory;

    protected Solver $solver;
    protected AutomathProblem $automathProblem;

    protected $casts = [
        'status' => QuizStatus::class,
        'vars' => 'array',
        'solution' => 'array'
    ];

    public function problem()
    {
        return $this->belongsTo(Problem::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function getSolver() : Solver
    {
        if(!isset($this->solver))
        {
            $this->solver = $this->problem->problemDefinition->getSolverInstance();
            $this->solver->setProblem($this->getProblem());
        }
        
        return $this->solver;
    }

    public function getProblem() : AutomathProblem
    {
        if(!isset($this->automathProblem))
        {
            $this->automathProblem = $this->problem->problemDefinition->getProblemInstance();

            foreach($this->vars as $k => $value)
            {
                $this->automathProblem->set($k, $value);
            }
        }
        
        return $this->automathProblem;
    }

    public function grade($input) : int
    {
        $solution = $this->getSolver()->solutionFromInput($input);
        $this->score = $this->getSolver()->grade($solution);

        // Pass Solution to grade() and let Eloquent cast the property
        // to array.
        $this->solution = $solution;
        
        return $this->score;
    }
}
