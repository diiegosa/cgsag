<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('criando cidades');
        City::create([ 'name' => 'recife' ]);
        City::create([ 'name' => 'brasília' ]);
        City::create([ 'name' => 'são paulo' ]);
        City::create([ 'name' => 'rio de janeiro' ]);
    }
}
