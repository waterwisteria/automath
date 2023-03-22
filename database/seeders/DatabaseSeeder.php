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
            'password' => '$2y$10$NkeW98BgsPUR0vRd7lByRuk.0KaWiXYtEMmLVt1yfRPNbCyMZsZH.' // "demo"
        ]);

        $this->call(\Database\Seeders\ProblemsSeeder::class);
    }
}
