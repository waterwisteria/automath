<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'demo',
            'email' => 'demo@demo',
            'password' => '$2y$10$8Kbf2uPDvWaftpwYbbDXPOJv1tfqiV24mC8w3weh1q8AAwtwH4gDO'
        ]);

        $this->call(\Database\Seeders\ProblemsSeeder::class);
    }
}
