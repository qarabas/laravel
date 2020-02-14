<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i = 1; $i<=5; $i++){
            $data [] = [
                'title'=>'Архив- '.rand(1,500)
            ];
        }

        DB::table('arches')->insert($data);
    }
}
