<?php

use Illuminate\Database\Seeder;
use App\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_sponsors = config('sponsors');

        foreach ($array_sponsors as $sponsor) {
            
            $new_sponsor=  new Sponsor();

            $new_sponsor->name=$sponsor['name'];
            $new_sponsor->duration=$sponsor['duration'];
            $new_sponsor->price=$sponsor['price'];

            $new_sponsor->save();

        }
    }
}
