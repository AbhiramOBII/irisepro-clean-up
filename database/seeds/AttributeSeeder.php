<?php

use Illuminate\Database\Seeder;
use App\Attribute;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            'Aptitude',
            'Attitude',
            'Communication',
            'Execution'
        ];

        foreach ($attributes as $attribute) {
            Attribute::create([
                'name' => $attribute,
                'status' => 'active'
            ]);
        }
    }
}
