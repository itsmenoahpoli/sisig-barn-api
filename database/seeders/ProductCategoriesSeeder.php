<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Products\ProductCategory;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_categories = ["Meals", "Drinks", "Combo", "Ala-Carte", "Add-ons"];
        
        foreach ($product_categories as $category) {
            ProductCategory::create([
                'name' => $category
            ]);
        }
    }
}
