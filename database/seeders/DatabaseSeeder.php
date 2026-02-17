<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Project;
use App\Models\SceneSetting;
use App\Models\Section;
use App\Models\SiteSetting;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->create([
            'site_name' => 'Ava Sterling',
            'tagline' => 'Senior Full-Stack + Creative WebGL Engineer',
            'hero_headline' => 'Crafting immersive digital products at the edge of design and performance.',
            'hero_subheadline' => 'I build premium web experiences with robust backend architecture and cinematic 3D interfaces.',
            'primary_email' => 'hello@avasterling.dev',
            'location' => 'Berlin, Germany',
            'seo_title_default' => 'Ava Sterling | Premium 3D Portfolio',
            'seo_description_default' => 'Production-grade Laravel + React + WebGL portfolio showcasing featured work and engineering experience.',
            'seo_image_default' => '/storage/seo/default-og.jpg',
            'canonical_base_url' => 'https://portfolio.example.com',
            'social_links' => ['github' => 'https://github.com/ava', 'linkedin' => 'https://linkedin.com/in/ava'],
            'effects_enabled' => true,
            'effects_intensity' => 80,
        ]);

        collect([
            ['key' => 'hero', 'title' => 'Hero', 'subtitle' => 'Welcome'],
            ['key' => 'about', 'title' => 'About', 'subtitle' => 'Who I am'],
            ['key' => 'skills', 'title' => 'Skills', 'subtitle' => 'Toolbox'],
            ['key' => 'projects', 'title' => 'Projects', 'subtitle' => 'Featured Work'],
            ['key' => 'experience', 'title' => 'Experience', 'subtitle' => 'Career'],
            ['key' => 'contact', 'title' => 'Contact', 'subtitle' => 'Let\'s build'],
        ])->each(fn ($section, $i) => Section::query()->create([
            ...$section,
            'content_html' => '<p>Database-managed section content for ' . $section['key'] . '.</p>',
            'sort_order' => $i,
            'is_enabled' => true,
        ]));

        Project::query()->create([
            'title' => 'Nebula Commerce',
            'slug' => 'nebula-commerce',
            'short_description' => 'Realtime B2B dashboard with cinematic product visualizer.',
            'long_description_html' => '<p>Scaled the platform to millions of events per day with SSR-first architecture.</p>',
            'tech_stack' => ['Laravel', 'React', 'R3F', 'Redis'],
            'role' => 'Lead Architect',
            'year' => '2025',
            'client' => 'Confidential Retail Group',
            'featured' => true,
            'sort_order' => 1,
            'cover_image_path' => '/storage/projects/nebula.jpg',
            'model_gltf_path' => '/storage/models/nebula.gltf',
            'model_scale' => 1.2,
            'model_position' => [0, 0, 0],
            'model_rotation' => [0, 0.5, 0],
            'seo_title' => 'Nebula Commerce Case Study',
            'seo_description' => 'How we built an immersive enterprise commerce platform.',
            'seo_image' => '/storage/projects/nebula-og.jpg',
        ]);

        Experience::query()->create([
            'company' => 'Nova Labs',
            'role' => 'Senior Full-Stack Architect',
            'location' => 'Remote',
            'start_date' => '2022-04-01',
            'end_date' => null,
            'description_html' => '<p>Owned product architecture and high-performance interactive UIs.</p>',
            'sort_order' => 1,
        ]);

        collect([
            ['name' => 'Laravel', 'level' => 95, 'category' => 'Backend'],
            ['name' => 'React', 'level' => 93, 'category' => 'Frontend'],
            ['name' => 'Three.js', 'level' => 88, 'category' => '3D'],
        ])->each(fn ($skill, $i) => Skill::query()->create([...$skill, 'sort_order' => $i]));

        SceneSetting::query()->create([
            'background_mode' => 'aurora',
            'hero_model_path' => '/storage/models/hero.gltf',
            'hero_float_speed' => 0.55,
            'hero_rotation_speed' => 0.2,
            'bloom_intensity' => 0.25,
            'ambient_light_intensity' => 0.6,
            'section_scene_states' => [
                'hero' => ['camera' => [0, 0, 7], 'light' => '#70e1ff', 'target' => [0, 0, 0]],
                'projects' => ['camera' => [1.4, 0.3, 5.2], 'light' => '#b484ff', 'target' => [0, 0, 0]],
            ],
        ]);
    }
}
