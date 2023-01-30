<?php

namespace Database\Seeders;

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
        $users = collect();
        for($i=1;$i<=10;$i++){
            $users->add( \App\Models\User::factory()->create([
                'email' => 'user' . $i . '@szerveroldali.hu'
            ])
            );
        }


        \App\Models\User::factory()->create([
            'name' => 'ADMIN',
            'email' => 'admin@szerveroldali.hu',
            'password' => '$2a$10$a/PR6.CYX8Lc43W3pzEbne.ch5zNI6kMW2vVzRUh49ayDhrMuuejK',//adminpwd-bcrypt
            'is_admin' => 'true',
        ]);

        $items = \App\Models\Item::factory(10)->create();

        $comments = \App\Models\Comment::factory(20)->create();

        $labels = \App\Models\Label::factory(5)->create();

        $comments->each(function ($comment) use (&$users, &$items) {
            // Szerző hozzáadása
            $comment->author()->associate($users->random())->save();
            // Post Hozzáadása
            $comment->item()->associate($items->random())->save();
        });

        $items->each(function ($item) use (&$labels){
            $item->labels()->sync(
                $labels->random(
                    rand(1, $labels->count())
                )
                );
        });
    }
}
