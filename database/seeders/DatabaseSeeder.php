<?php

namespace Database\Seeders;

use App\Models\SellerApplicationFields;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $drop_down_fields = [
            [
                "group" => "category",
                "text" => "Graphics",
                "order" => 1
            ],
            [
                "group" => "category",
                "text" => "Fonts",
                "order" => 2
            ],
            [
                "group" => "category",
                "text" => "Templates",
                "order" => 3
            ],
            [
                "group" => "category",
                "text" => "Add-ons",
                "order" => 4
            ],
            [
                "group" => "category",
                "text" => "Photos",
                "order" => 5
            ],
            [
                "group" => "category",
                "text" => "Web Themes",
                "order" => 6
            ],
            [
                "group" => "category",
                "text" => "3D",
                "order" => 7
            ],
            
            
            [
                "group" => 'perspective',
                "text" => "I don't care what it takes, my products are the highes quality possible",
                "order" => 1
            ],
            [
                "group" => 'perspective',
                "text" => "I put in enough effort to make my products pretty high quality, but at some point my time is better spent elsewhere",
                "order" => 2
            ],
            [
                "group" => 'perspective',
                "text" => "I try to get quality products out quickly, even if I need to take a shortcut now and then just",
                "order" => 3
            ],
            [
                "group" => 'perspective',
                "text" => "I spend the minimum amount of time & effort it takes to create products that are acceptable quality",
                "order" => 4
            ],
            [
                "group" => 'perspective',
                "text" => "Quantity is more important to me than quality",
                "order" => 5
            ],

            [
                "group" => "experience",
                "text" => "I sell on multiple marketplaces and through my own website",
                "order" => 1
            ],
            [
                "group" => "experience",
                "text" => "I have experience selling through my own website",
                "order" => 2
            ],
            [
                "group" => "experience",
                "text" => "I have experience selling through multiple marketplaces",
                "order" => 3
            ],
            [
                "group" => "experience",
                "text" => "I have experience selling through one online marketplcae",
                "order" => 4
            ],
            [
                "group" => "experience",
                "text" => "I'm new to selling creative products online            ",
                "order" => 5
            ],

            [            
                "group" => "understanding",
                "text" => "I have an extensive background in business and/or marketting",
                "order" => 1

            ],
            [
                "group" => "understanding",
                "text" => "I'm familiar with some skills & techniques, but I'm not sure how to apply them when selling my creative work",
                "order" => 2

            ],
            [
                "group" => "understanding",
                "text" => "I'm vaguely aware of basic business & marketting concepts",
                "order" => 3

            ],
            [
                "group" => "understanding",
                "text" => "I'm not interested in understanding business & marketting            ",
                "order" => 4
            ],

        ];

        foreach($drop_down_fields as $field)
        {
            SellerApplicationFields::create([
             'group' => $field['group'],
             'text' => $field['text'],
             'order' => $field['order'],
           ]);
         }
    }

}
