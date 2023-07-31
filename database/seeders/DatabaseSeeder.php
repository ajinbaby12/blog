<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        Schema::disableForeignKeyConstraints();
        Category::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        // truncating is used to remove existing data when 'db:seed' is called alone. Otherwise the table is populated with unnecessary data. Can remove the above lines if seeding is only used during a fresh migration.

        $user = User::factory()->create([
            'name' => 'Ajin Baby'
        ]); // create a random User but name should be Ajin Baby

        Post::factory(5)->create([
            'user_id' => $user->id
        ]); // create 5 random Posts but the user_id of each post should be the id of the user Ajin Baby

        // $user = User::factory()->create();

        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);

        // $hobby = Category::create([
        //     'name' => 'Hobbies',
        //     'slug' => 'hobbies'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $personal->id,
        //     'slug' => 'my-personal-post-1',
        //     'title' => 'My First Personal Post',
        //     'excerpt' => 'First post excerpt',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        // ]);

        // Post::create([
        //     'user_id' => $user->id,
        //     'category_id' => $work->id,
        //     'slug' => 'my-work-post-1',
        //     'title' => 'My First work Post',
        //     'excerpt' => 'Second post excerpt',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
        // ]);
    }
}
