<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = ['gdr', 'simulazione', 'rts', 'fps', 'fighting'];
        foreach($categorie as $tag){
            $nuovo_tag = new Tag();
            $nuovo_tag->name = $tag;
            $nuovo_tag->slug = Str::of($tag)->slug("-");
            $nuovo_tag->save();
        }
    }
}
