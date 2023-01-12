<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProblemDefinition;
use App\Models\Problem;
use App\Models\User;
use App\Enums\QuizStatus;
use Automath\Equations\Solution;

class ProblemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pda = ProblemDefinition::create([ 
            'description' => '2 terms additions',
            'instigator' => \Automath\Equations\IntegerInstigator::class,
            'problem' => \Automath\Equations\IntegerProblem::class,
            'solver' => \Automath\Equations\Addition\Solver::class
        ]);

        $pds = ProblemDefinition::create([
            'description' => '2 terms substraction',
            'instigator' => \Automath\Equations\IntegerInstigator::class,
            'problem' => \Automath\Equations\IntegerProblem::class,
            'solver' => \Automath\Equations\Substraction\Solver::class
        ]);

        Problem::create([
            'problem_definition_id' => $pda->id,
            'description:en' => 'addition single digit terms',
            'description:fr' => 'additions de termes simples',
            'problems' => 10,
            'target_score' => 90,
            'target_time' => 1440,
            'instigator_params' => [ 'aRange' => [ 1, 9 ], 'bRange' => [ 1, 9 ] ]
        ]);

        Problem::create([
            'problem_definition_id' => $pda->id,
            'description:en' => 'addition double digit terms',
            'description:fr' => 'additions de termes doubles',
            'problems' => 10,
            'target_score' => 90,
            'target_time' => 1440,
            'instigator_params' => [ 'aRange' => [ 1, 50 ], 'bRange' => [ 1, 50 ] ]
        ]);

        Problem::create([
            'problem_definition_id' => $pds->id,
            'description:en' => 'substraction single digit terms, positive results',
            'description:fr' => 'soustractions de termes simple, résultats positifs',
            'problems' => 10,
            'target_score' => 90,
            'target_time' => 1440,
            'instigator_params' => [ 'aRange' => [ 1, 10 ], 'bRange' => [ 1, 10 ], 'biggestTermFirst' => true ]
        ]);

        $lastMonth = time() - (86400 * 30);
        $user = User::find(1);
        
        // Let's generate 10 completed quizzes and 2 pending...
        for($i = 0; $i <= 9; $i++)
        {
            $quizzGen = new \App\Quiz\Generator($user, 'Simple arithmetic problems ' . $i + 1);
            $quizzGen->addProblemsRandomSolution(Problem::find(1), 20);
            $quizzGen->addProblemsRandomSolution(Problem::find(2), 15);
            $quizzGen->addProblemsRandomSolution(Problem::find(3), 10);

            // Solve them
            $maxCorrect = rand(0, 19);
            foreach($quizzGen->getQuizEntries() as $quizEntry)
            {
                if(rand(0, 19) < $maxCorrect)
                {
                    // Correct solution
                    $solution = $quizEntry->getSolver()->getSolution()->get('x');
                }

                else
                {
                    // Erroneous solution, at least it should, statistically ;)
                    $solution = rand(-100, 100);
                }

                $quizEntry->grade($solution);
                $quizEntry->save();
            }

            $quizzGen->getQuiz()->time_spent = rand(60, 300);
            $quizzGen->getQuiz()->close();
            $quizzGen->getQuiz()->created_at = date('Y-m-d H:i:s', $lastMonth += 86400 );
            $quizzGen->getQuiz()->save([ 'timestamps' => false ]);
        }

        // ...2 pending
        for($i = 0; $i <= 1; $i++)
        {
            $quizzGen = new \App\Quiz\Generator($user, 'My arithmetic problems ' . $i + 1);
            $quizzGen->addProblemsRandomSolution(Problem::find(1), 5);
            $quizzGen->addProblemsRandomSolution(Problem::find(2), 5);
            $quizzGen->addProblemsRandomSolution(Problem::find(3), 5);

            $quizzGen->getQuiz()->created_at = date('Y-m-d H:i:s', $lastMonth += 86400 );
            $quizzGen->getQuiz()->save([ 'timestamps' => false ]);
        }
    }
}
