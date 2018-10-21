<?php

use Illuminate\Database\Seeder;

class countriesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\country::class, 50)->create();
    }
}
