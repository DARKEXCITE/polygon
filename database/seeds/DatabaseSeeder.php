<?php

use Illuminate\Database\Seeder;
use App\Models\BlogPost;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $blogPostsQuantity = 25;

        $this->call(UsersTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        factory(BlogPost::class, $blogPostsQuantity)->create();
    }
}
