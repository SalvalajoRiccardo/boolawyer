<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 25 ; $i++) { 

            
            User::create([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'address' => $faker->address(),
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber(),
                'password' => bcrypt('password'),
                'slug' => Str::slug($faker->firstName().' '.$faker->firstName(), '-'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ]);
          

        }
    }
}
