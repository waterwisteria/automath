<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plans;
use App\Models\PlanUnits;
use App\Models\User;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plans::create([ 'name' => 'PRIMARY_ADDITIONS_SUBSTRACTIONS' ]);
        PlanUnits::create([ 'plans_id' => 1, 'practice_unit' => 'ADDITION_SINGLE_DIGIT_TERMS', 'sort' => 0 ]);
        PlanUnits::create([ 'plans_id' => 1, 'practice_unit' => 'ADDITION_DOUBLE_DIGIT_TERMS', 'sort' => 1 ]);

        User::create([
            'name' => 'potato',
            'email' => 'martin@prieto.live',
            'current_plan' => 1,
            'last_unit_completed' => 0,
            'password' => '$2y$10$8Kbf2uPDvWaftpwYbbDXPOJv1tfqiV24mC8w3weh1q8AAwtwH4gDO'
        ]);
    }
}
