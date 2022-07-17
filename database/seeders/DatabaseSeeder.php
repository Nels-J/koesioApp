<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DatabaseSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;       // nel ajout

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()       // nel ajout
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()      // nel ajout
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // nel ajout - génère 3 utilisateurs simples
        foreach (range(1, 3) as $i) {
            User::create(
                [
                    'name' => $this->faker->name(),
                    'email' => $this->faker->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IX',
                    'remember_token' => Str::random(10),
                    'valid' => true,
                ]
            );
        }

        // nel ajout - génère 2 utilisateurs administrateur
        foreach (range(1, 2) as $i) {
            User::create(
                [
                    'name' => $this->faker->name(),
                    'email' => $this->faker->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'password' => Hash::make('$2y$10$92IX'),
                    'remember_token' => Str::random(10),
                    'valid' => true,
                    'role' => 'admin',
                ]
            );
        }

        // nel ajout - génère des publications/posts
        foreach (range(1, 9) as $i) {
            Post::create([
                'title' => 'Post ' . $i,
                'slug' => 'post-' . $i,
                'content' => $this->faker->text(150),
                'user_id' => 3,
            ]);
        }

    }
}
