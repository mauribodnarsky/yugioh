<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SubtypesCard extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_types_cards')->insert([
            [
                'id_type_card' => 1,
                'name' => 'Monstruo de ritual',
            ],
            [
                'id_type_card' => 1,
                'name' => 'Monstruo de efecto',
            ],
            [
                'id_type_card' => 1,
                'name' => 'Monstruo normal',
            ],
            [
                'id_type_card' => 2,
                'name' => 'Carta Magica de contraefecto',
            ],
            
            [
                'id_type_card' => 2,
                'name' => 'Carta Magica de juego rapido',
            ],
            
            [
                'id_type_card' => 3,
                'name' => 'Carta Trampa de contraefecto',
            ],
        ]);    }
}
