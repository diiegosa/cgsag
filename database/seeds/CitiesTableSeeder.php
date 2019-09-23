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
        City::create([ 'name' => 'curitiba' ]);
        City::create([ 'name' => 'belo horizonte' ]);
        City::create([ 'name' => 'porto alegre' ]);
        City::create([ 'name' => 'salvador' ]);
        City::create([ 'name' => 'são luís' ]);
        City::create([ 'name' => 'fortaleza' ]);
        City::create([ 'name' => 'natal' ]);
        City::create([ 'name' => 'vitória' ]);
        City::create([ 'name' => 'manaus' ]);
        City::create([ 'name' => 'florianópolis' ]);
    }
}
