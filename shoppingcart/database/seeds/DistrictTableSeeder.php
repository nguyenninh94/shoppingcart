<?php

use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\District::create([
           'name' => 'Tu Son',
           'province_id' => 1
        ]);

        App\District::create([
           'name' => 'Yen Phong',
           'province_id' => 1
        ]);

        App\District::create([
           'name' => 'Tien Du',
           'province_id' => 1
        ]);

        App\District::create([
           'name' => 'Hoan Kiem',
           'province_id' => 2
        ]);

        App\District::create([
           'name' => 'Dong Da',
           'province_id' => 2
        ]);

        App\District::create([
           'name' => 'Cau Giay',
           'province_id' => 2
        ]);

        App\District::create([
           'name' => 'Do Son',
           'province_id' => 3
        ]);

        App\District::create([
           'name' => 'Ngo Quyen',
           'province_id' => 3
        ]);

        App\District::create([
           'name' => 'Le Chan',
           'province_id' => 3
        ]);

        App\District::create([
           'name' => 'Ha Long',
           'province_id' => 4
        ]);

        App\District::create([
           'name' => 'Mong Cai',
           'province_id' => 4
        ]);

        App\District::create([
           'name' => 'Cam Pha',
           'province_id' => 4
        ]);
    }
}
