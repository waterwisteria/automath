<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Automath\Solver;
use Automath\Problem;

class ProblemDefinition extends Model
{
    use HasFactory;

    public function problem()
    {
        return $this->hasMany(Problem::class);
    }

    /**
     * Get a new Automath solver instance
     * 
     * @return Solver
     * 
     */
    public function getSolverInstance() : Solver
    {
        return new ($this->solver);
    }

    /**
    * Get a new Automath problem instance
    *
    * @return Solver
    *
    */
    public function getProblemInstance() : Problem
    {
        return new ($this->problem);
    }
}