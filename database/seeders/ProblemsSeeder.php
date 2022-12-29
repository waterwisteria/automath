<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProblemDefinition;
use App\Models\Problem;
use App\Models\User;
use App\Enums\QuizStatus;

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
            'description' => 'addition single digit terms',
            'problems' => 10,
            'target_score' => 90,
            'target_time' => 1440,
            'instigator_params' => [ 'aRange' => [ 1, 9 ], 'bRange' => [ 1, 9 ] ]
        ]);

        Problem::create([
            'problem_definition_id' => $pda->id,
            'description' => 'addition double digit terms',
            'problems' => 10,
            'target_score' => 90,
            'target_time' => 1440,
            'instigator_params' => [ 'aRange' => [ 1, 50 ], 'bRange' => [ 1, 50 ] ]
        ]);

        Problem::create([
            'problem_definition_id' => $pds->id,
            'description' => 'substraction single digit terms, biggest first',
            'problems' => 10,
            'target_score' => 90,
            'target_time' => 1440,
            'instigator_params' => [ 'aRange' => [ 1, 10 ], 'bRange' => [ 1, 10 ], 'biggestTermFirst' => true ]
        ]);

        $user = User::create([
            'name' => 'potato',
            'email' => 'martin@prieto.live',
            //'current_plan' => 1,
            //'last_unit_completed' => 0,
            'password' => '$2y$10$8Kbf2uPDvWaftpwYbbDXPOJv1tfqiV24mC8w3weh1q8AAwtwH4gDO'
        ]);

        $faker = \Faker\Factory::create('en_US');

        // Let's generate 10 completed quizzes and 2 pending...
        for($i = 0; $i <= 10; $i++)
        {
            $quizzGen = new \App\Quiz\Generator($user, $faker->realText(22));
            $quizzGen->addProblemsRandomSolution(Problem::find(1), 20);
            $quizzGen->addProblemsRandomSolution(Problem::find(2), 20);
            $quizzGen->addProblemsRandomSolution(Problem::find(3), 20);

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

            $quizzGen->getQuiz()->close();
            $quizzGen->getQuiz()->save();
        }

        // ...2 pending
        for($i = 0; $i <= 2; $i++)
        {
            $quizzGen = new \App\Quiz\Generator($user, $faker->realText(22));
            $quizzGen->addProblemsRandomSolution(Problem::find(1), 5);
            $quizzGen->addProblemsRandomSolution(Problem::find(2), 5);
            $quizzGen->addProblemsRandomSolution(Problem::find(3), 5);
        }
    }
}
