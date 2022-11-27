<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProblemDefinitions;
use App\Models\Problems;

class ProblemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pd = ProblemDefinitions::create([ 
            'description' => '2 terms arithmetics',
            'instigator' => Automath\Equations\IntegerInstigator::class,
            'problem' => Automath\Equations\IntegerProblem::class,
            'solver' => Automath\Equations\Addition\Solver::class
        ]);

        Problems::create([
            'problem_definitions_id' => $pd->id,
            'description' => 'addition single digit terms',
            'problems' => 10,
            'target_score' => 90,
            'target_time' => 1440,
            'ranges' => json_encode([ 'a' => [ 1, 9 ], 'b' => [ 1, 9 ] ])
        ]);

        Problems::create([
            'problem_definitions_id' => $pd->id,
            'description' => 'addition double digit terms',
            'problems' => 10,
            'target_score' => 90,
            'target_time' => 1440,
            'ranges' => json_encode([ 'a' => [ 1, 50 ], 'b' => [ 1, 50 ] ])
        ]);
    }
}
