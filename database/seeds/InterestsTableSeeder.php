<?php

use Illuminate\Database\Seeder;
use App\Interest;

class InterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('criando áreas de interesse');
        Interest::create([ 'name' => 'futebol' ]);
        Interest::create([ 'name' => 'teatro' ]);
        Interest::create([ 'name' => 'política' ]);
        Interest::create([ 'name' => 'música' ]);
    }
}
