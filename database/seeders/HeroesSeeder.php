<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listHeroesId = [
            1011334,
            1017100,
            1009144,
            1010699,
            1009146,
            1016823,
            1009148,
            1009149,
            1010903,
            1011266,
            1010354,
            1010846,
            1017851,
            1012717,
            1011297,
            1011031,
            1009150,
            1011198,
            1011175,
            1011136,
        ];

        foreach($listHeroesId as $id) {
            DB::table('heroes')->insert(
                ['id' => $id],
            );
        }
    }
}
