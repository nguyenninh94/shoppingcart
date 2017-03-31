<?php

use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Province::create([
           'name' => 'Bac Ninh',
        ]);

        App\Province::create([
           'name' => 'Ha Noi',
        ]);

        App\Province::create([
           'name' => 'Hai Phong',
        ]);

        App\Province::create([
           'name' => 'Quang Ninh',
        ]);
    }
}
