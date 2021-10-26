<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'HTML', 'color' => 'danger'],
            ['name' => 'JS', 'color' => 'warning'],
            ['name' => 'CSS', 'color' => 'primary'],
            ['name' => 'PHP', 'color' => 'secondary'],
            ['name' => 'VueJS', 'color' => 'success'],
            ['name' => 'Laravel', 'color' => 'danger']
        ];

        foreach ($categories as $category) {
            $newCategory = new Category();

            $newCategory->name = $category['name'];
            $newCategory->color = $category['color'];
            $newCategory->slug = Str::slug($category['name'], '-');

            $newCategory->save();
        }
    }
}
