<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $title_ids = [];
        foreach (\App\models\Cell::getCellIds() as $cell_id){
            for($i = 1; $i<=3;$i++){
                $rand = rand(1,100 + $i) + $i;
                if (!in_array($rand, $title_ids)){
                    $data [] = [
                        'title'=>'Папка-'.$rand,
                        'cell_id'=> $cell_id,
                    ];
                    $title_ids[] = $rand;
                }
            }
        }

        DB::table('dirs')->insert($data);
    }
}
