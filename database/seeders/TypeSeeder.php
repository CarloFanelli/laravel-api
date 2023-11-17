<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['FrontEnd Vue', 'BackEnd Laravel', 'FullStack Project', 'WordPress'];

        foreach ($types as $type) {

            $new_type = new Type();
            $new_type->name = $type;
            $new_type->slug = Str::slug($type, '-');

            $new_type->save();
        }
    }
}
