<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'name' => 'Water',
            'price' => 0.65,
            'img' => 'https://cdn-icons-png.flaticon.com/512/3829/3829576.png',
        ]);

        Article::create([
            'name' => 'Juice',
            'price' => 1,
            'img' => 'https://img.freepik.com/vector-premium/botella-jugo-jugo-limon-jugo-naranja_726899-46.jpg?w=2000',
        ]);

        Article::create([
            'name' => 'Soda',
            'price' => 1.50,
            'img' => 'https://previews.123rf.com/images/airdone/airdone1608/airdone160800032/60658872-ilustraci%C3%B3n-del-vector-de-la-bebida-de-soda-para-llevar-en-el-estilo-de-dibujo-coloreado.jpg',
        ]);

        Article::create([
            'name' => 'Yogurt',
            'price' => 1.25,
            'img' => 'https://png.pngtree.com/png-clipart/20210314/original/pngtree-yogurt-clipart-strawberry-flavored-yogurt-png-image_6093206.jpg',
        ]);
    }
}
