<?php

use Illuminate\Database\Seeder;
use App\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_specializations = config('specializations');
        foreach ($array_specializations as $specialization) {
            $new_specialization = new Specialization();
            
            $new_specialization->name = $specialization['name'];

            $new_specialization->save();
        }

    }
}
