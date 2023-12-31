<?php

namespace Database\Seeders;

use App\Models\Comment;
use Database\Seeders\Traits\ForeignKeyCheck;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    use TruncateTable, ForeignKeyCheck;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();
        $this->truncate('comments');
        Comment::factory(3)->create();
        $this->enableForeignKeys();
    }
}
