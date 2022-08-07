<?php

use Illuminate\Database\Seeder;

class ComplaintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ComplaintType::create([
            "name" => "اقتراح سعر منتج معين",
            "name_en" => "Suggest a price for a specific product"
        ]);

    }
}
