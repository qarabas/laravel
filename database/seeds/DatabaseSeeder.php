<?php

use Illuminate\Database\Seeder;
use app\models\Arch;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(ArchesTableSeeder::class);
         $this->call(CellsTableSeeder::class);
         $this->call(DirsTableSeeder::class);
         $this->call(FilesTableSeeder::class);
    }
}
