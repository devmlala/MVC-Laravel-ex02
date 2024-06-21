<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LivroFulano;
use Faker\Factory as Faker;


class LivroFulanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run()
        {
    
            $faker = Faker::create();
    
            foreach(range(1, 30) as $index) {
                LivroFulano::create([
                    'titulo' => $faker->sentence($nbWords = 4),
                    'autor' => $faker->name,
                    'isbn' => $faker->isbn13,
                ]);
            }
            
    
    
            /*
            LivroFulano::create([
                'titulo' => 'Dom Casmurro',
                'autor' => 'Machado de Assis',
                'isbn' => '67584',
            ]);
            */
        }



    }



