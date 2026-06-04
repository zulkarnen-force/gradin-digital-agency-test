<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('couriers')->insert([
            [
                'first_name' => 'Budiono',
                'last_name' => 'Hadi Agung',
                'level' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Muhammad',
                'last_name' => 'Budiono',
                'level' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'first_name' => 'Joko',
                'last_name' => 'Widodo',
                'level' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Agus',
                'last_name' => 'Salim',
                'level' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
                [
                    'first_name' => 'Siti',
                    'last_name' => 'Nurhaliza',
                    'level' => '5',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'first_name' => 'Budi',
                    'last_name' => 'Santoso',
                    'level' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'first_name' => 'Dewi',
                    'last_name' => 'Kurniawan',
                    'level' => '2',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'first_name' => 'Rudi',
                    'last_name' => 'Hartono',
                    'level' => '3',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'first_name' => 'Lina',
                    'last_name' => 'Sari',
                    'level' => '4',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                 [
                    'first_name' => 'Andi',
                    'last_name' => 'Pratama',
                    'level' => '5',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'first_name' => 'Sari',
                    'last_name' => 'Wulandari',
                    'level' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'first_name' => 'Rina',
                    'last_name' => 'Putri',
                    'level' => '2',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
        ]);
    }
}
