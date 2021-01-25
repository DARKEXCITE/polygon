<?php

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $categories[] = [
            'title'       => 'Без категории',
            'slug'        => Str::slug('Без категории'),
            'parent_id'   => 0,
            'created_at'  => now(),
            'updated_at'  => now()
        ];

        for ($i = 0; $i <= 10; $i++) {
            $categories[] = [
                'title'         => 'Категория #' . $i,
                'slug'          => Str::slug('Категория #' . $i),
                'parent_id'     => ($i > 4) ? rand(1, 4) : 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ];
        }

        \DB::table('blog_categories')->insert($categories);
    }
}
