<?php

use Illuminate\Database\Seeder;

class WardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ward::create([
           'name' => 'Dong Ky',
           'district_id' => 1
        ]);

        App\Ward::create([
           'name' => 'Phu Khe',
           'district_id' => 1
        ]);

        App\Ward::create([
           'name' => 'Van Mon',
           'district_id' => 2
        ]);

        App\Ward::create([
           'name' => 'Dong Tho',
           'district_id' => 2
        ]);

        App\Ward::create([
           'name' => 'Noi Due',
           'district_id' => 3
        ]);

        App\Ward::create([
           'name' => 'Lim',
           'district_id' => 3
        ]);

        App\Ward::create([
           'name' => 'Hang Dao',
           'district_id' => 4
        ]);

        App\Ward::create([
           'name' => 'Hang Buom',
           'district_id' => 4
        ]);

        App\Ward::create([
           'name' => 'Kim Lien',
           'district_id' => 5
        ]);

        App\Ward::create([
           'name' => 'Nam Dong',
           'district_id' => 5
        ]);

        App\Ward::create([
           'name' => 'Mai Dich',
           'district_id' => 6
        ]);

        App\Ward::create([
           'name' => 'Nghia Tan',
           'district_id' => 6
        ]);

        App\Ward::create([
           'name' => 'La Son',
           'district_id' => 7
        ]);

        App\Ward::create([
           'name' => 'La Thanh',
           'district_id' => 7
        ]);

        App\Ward::create([
           'name' => 'Ngoc Son',
           'district_id' => 8
        ]);

        App\Ward::create([
           'name' => 'Duong Xuan',
           'district_id' => 8
        ]);

        App\Ward::create([
           'name' => 'Dong Huong',
           'district_id' => 9
        ]);

        App\Ward::create([
           'name' => 'Thanh Lam',
           'district_id' => 9
        ]);

        App\Ward::create([
           'name' => 'Tam Hoa',
           'district_id' => 10
        ]);

        App\Ward::create([
           'name' => 'Tam Linh',
           'district_id' => 10
        ]);

        App\Ward::create([
           'name' => 'Canh Son',
           'district_id' => 11
        ]);

        App\Ward::create([
           'name' => 'Canh Duong',
           'district_id' => 11
        ]);

        App\Ward::create([
           'name' => 'Quynh Vu',
           'district_id' => 12
        ]);

        App\Ward::create([
           'name' => 'Phong Dong',
           'district_id' => 12
        ]);
    }
}
