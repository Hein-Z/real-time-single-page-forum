<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Like;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Category::factory(10)->create();
        Question::factory(10)->create();
        Reply::factory(50)->create()->each(function ($reply) {
            $reply->likes()->save(Like::factory()->make());
        });

    }
}

//App\Models\Reply::find(1);
//App\Models\User::find(1);
//App\Models\Question::find(1);
//App\Models\User::find(1);

