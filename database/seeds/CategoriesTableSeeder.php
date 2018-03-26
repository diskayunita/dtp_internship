<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\CategoryTranslation;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catsen = ['news','blog','techno'];
        $descsen = ['this is category news','this is category blog','this is category techno'];
        $catsid = ['berita','blog','techno'];
        $descsid = ['Ini adalah kategori berita','Ini adalah kategori blog','Ini adalah kategori techno'];
        
        foreach( $catsen as $index => $cat)
        {
            $category = Category::create([
                'name'=>$cat,
                'description'   => $descsen[$index]
            ]);

            foreach(config('app.languages') as $key=>$lang)
            {
                $category->translation()->save(
                    new CategoryTranslation([
                        'name'     => $key ? $catsid[$index] : $cat,
                        'description'   => $key ? $descsid[$index] : $descsen[$index],
                        'language'  => $lang,
                    ])
                );
            }
        }
    }
}
