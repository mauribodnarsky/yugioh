<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesCard extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_cards')->insert([
            [
                'name' => 'Monstruo',
            ],
            [
                'name' => 'Magica',
            ],
            [
                'name' => 'Trampa',
            ]
        ]);    }
}
