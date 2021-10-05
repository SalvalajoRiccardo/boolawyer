<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\User;
use App\Specialization;

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

            $name =$faker->firstName();
            $surname = $faker->lastName();
            
            User::create([
                'name' => $name,
                'surname' => $surname,
                'address' => $faker->address(),
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber(),
                'password' => bcrypt('password'),
                'slug' => Str::slug($name.' '.$surname, '-'),
                'services' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam praesentium voluptatum molestias unde repellat repudiandae, tempora iste, perferendis non reiciendis dolor, quaerat dolores corporis iusto quod accusantium omnis eum. Vero.',
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),

            ]);
            
          
        }
    }
}
