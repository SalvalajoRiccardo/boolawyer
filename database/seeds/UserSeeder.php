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
          
            $new_user = new User();

            
            $new_user->name= $faker->firstName();
            $new_user->surname= $faker->lastName();
            $new_user->email= $faker->email();
            $new_user->password= $faker->password(8, 10);
            $new_user->address= $faker->address();
            $new_user->phone= $faker->phoneNumber();
            $new_user->slug= Str::slug($new_user->name.$new_user->surname, '-');

            $new_user->save();

        }
    }
}
