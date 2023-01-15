<?php

namespace Database\Seeders;

use App\Models\Cierre;
use Illuminate\Database\Seeder;

class CierreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cierre = new Cierre;
        $cierre->parcial ='{"parcial1":0,"parcial2":1,"parcial3":0,"parcial4":0}';
        $cierre->estado = 1;

        $cierre->save();

    }
}
