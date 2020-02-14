<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilesTableSeeder extends Seeder
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
        foreach (\App\models\Dir::getDirIds() as $dir_id){
            for($i = 1; $i<=20;$i++){
                $rand = rand(1,1000 + $i) + $i;
                if (!in_array($rand, $title_ids)){
                    $data [] = [
                        'title'=>'Файл-'.$rand,
                        'dir_id'=> $dir_id,
                    ];
                    $title_ids[] = $rand;
                }
            }
        }

        DB::table('files')->insert($data);
    }
}
