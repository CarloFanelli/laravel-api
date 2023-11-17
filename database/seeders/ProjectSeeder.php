<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {

            $project = new Project();

            $project->type_id = rand(1, 4);
            $project->title = $faker->realText(15);
            $project->content = $faker->realText();
            $project->slug = Str::slug($project->title, '-');
            $project->cover_image = $faker->image('public/storage/placeholders', 640, 480, fullPath: false);
            $project->git_link = $faker->url();
            $project->project_link = $faker->url();

            $project->save();
        }
    }
}
