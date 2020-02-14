<?php

use App\models\Arch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CellsTableSeeder extends Seeder
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
        foreach (Arch::getArchIds() as $arch_id){
            for($i = 1; $i<=2;$i++){
                $rand = rand(1,100 + $i) + $i;
                if (!in_array($rand, $title_ids)){
                    $data [] = [
                        'title'=>'Ячейка-'.$rand,
                        'arch_id'=> $arch_id,
                    ];
                    $title_ids[] = $rand;
                }
            }
        }


        DB::table('cells')->insert($data);
    }
}
