<?php

namespace Database\Seeders;

use Database\Seeders\Traits\ForeignKeyCheck;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    use TruncateTable, ForeignKeyCheck;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();
        $this->truncate('users');
        $user  = \App\Models\User::factory(10)->create();
        $this->enableForeignKeys();
        
    }
}
