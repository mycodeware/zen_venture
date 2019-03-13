<?php

use Illuminate\Database\Seeder;
use App\Field;
use App\Category;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fields')->delete();
        DB::table('categories')->delete();
        $json = File::get("database/data/business_categories.json");
        $data = json_decode($json, true);
        foreach ($data as $field_id => $field_categories) {
            $field = Field::create([
                'id' => $field_id,
                'field_name' => $field_categories['name'],
            ]);
            if ($field_categories['categories']) {
                foreach ($field_categories['categories'] as $category_id => $category) {
                    $category = Category::create([
                        'id' => $category_id,
                        'field_id' => $field->id,
                        'category_name' => $category['name'],
                        'enterable' => $category['enterable'],
                    ]);
                }
            }
        }
    }
}
