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
    public function run()
    {
        SiteSetting::create([
            'site_name' => 'Ari Nova',
            'tagline' => 'Senior Full-Stack + WebGL Engineer',
            'hero_headline' => 'Building immersive digital products that ship and scale.',
            'hero_subheadline' => 'I design performant web platforms and cinematic interactive experiences.',
            'primary_email' => 'hello@arinova.dev',
            'location' => 'Berlin, Germany',
            'seo_title_default' => 'Ari Nova | Full-Stack Architect & WebGL Engineer',
            'seo_description_default' => 'Portfolio of Ari Nova featuring high-performance Laravel + React experiences and 3D product storytelling.',
            'seo_image_default' => '/images/seo/default-og.jpg',
            'canonical_base_url' => 'https://portfolio.example.com',
            'robots_index' => true,
            'robots_follow' => true,
            'social_links' => [
                'github' => 'https://github.com/arinova',
                'linkedin' => 'https://linkedin.com/in/arinova',
                'x' => 'https://x.com/arinova',
            ],
            'effects_enabled' => true,
            'effects_intensity' => 65,
        ]);

        $sections = [
            ['key' => 'hero', 'title' => 'Home', 'subtitle' => 'Immersive Product Engineering'],
            ['key' => 'about', 'title' => 'About', 'subtitle' => 'Architecture + craft'],
            ['key' => 'skills', 'title' => 'Skills', 'subtitle' => 'Execution across stack'],
            ['key' => 'projects', 'title' => 'Projects', 'subtitle' => 'Selected work'],
            ['key' => 'experience', 'title' => 'Experience', 'subtitle' => 'Teams and outcomes'],
            ['key' => 'contact', 'title' => 'Contact', 'subtitle' => 'Let\'s build something'],
        ];

        foreach ($sections as $index => $section) {
            Section::create([
                'key' => $section['key'],
                'title' => $section['title'],
                'subtitle' => $section['subtitle'],
                'content_html' => '<p>Demo content for ' . $section['title'] . ' section.</p>',
                'sort_order' => $index + 1,
                'is_enabled' => true,
                'seo_title' => $section['title'] . ' | Ari Nova',
                'seo_description' => 'Section about ' . strtolower($section['title']) . ' in Ari Nova portfolio.',
                'seo_image' => '/images/seo/' . $section['key'] . '.jpg',
            ]);
        }

        Project::insert([
            [
                'title' => 'Neon Commerce Engine',
                'slug' => 'neon-commerce-engine',
                'short_description' => 'Headless commerce platform with real-time 3D configurator.',
                'long_description_html' => '<p>Built a resilient Laravel microservice backend with React front-end and WebGL product previews.</p>',
                'tech_stack' => json_encode(['Laravel', 'React', 'MySQL', 'Redis', 'Three.js']),
                'role' => 'Lead Architect',
                'year' => '2024',
                'client' => 'RetailX',
                'featured' => true,
                'sort_order' => 1,
                'cover_image_path' => '/images/projects/neon-commerce.jpg',
                'model_gltf_path' => '/models/commerce-ring.glb',
                'model_scale' => 1.1,
                'model_position' => json_encode([0, 0, 0]),
                'model_rotation' => json_encode([0, 0.5, 0]),
                'seo_title' => 'Neon Commerce Engine Project',
                'seo_description' => 'A high-scale commerce architecture with interactive 3D product storytelling.',
                'seo_image' => '/images/projects/neon-commerce-og.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Aurora Analytics Suite',
                'slug' => 'aurora-analytics-suite',
                'short_description' => 'Premium BI dashboard with animated data narratives.',
                'long_description_html' => '<p>Designed a server-driven analytics UX with smooth transitions and dynamic visual metaphors.</p>',
                'tech_stack' => json_encode(['Laravel', 'Inertia', 'React', 'Framer Motion']),
                'role' => 'Full-Stack Engineer',
                'year' => '2023',
                'client' => 'DataOrbit',
                'featured' => true,
                'sort_order' => 2,
                'cover_image_path' => '/images/projects/aurora-analytics.jpg',
                'model_gltf_path' => '/models/aurora-cube.glb',
                'model_scale' => 0.9,
                'model_position' => json_encode([0, -0.1, 0]),
                'model_rotation' => json_encode([0.2, 0, 0]),
                'seo_title' => 'Aurora Analytics Suite Case Study',
                'seo_description' => 'A data platform blending performance, accessibility, and animated storytelling.',
                'seo_image' => '/images/projects/aurora-analytics-og.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Experience::insert([
            [
                'company' => 'Polar Stack',
                'role' => 'Senior Full-Stack Architect',
                'location' => 'Remote',
                'start_date' => '2022-01-01',
                'end_date' => null,
                'description_html' => '<p>Architected Laravel + React platforms for enterprise clients with strict performance budgets.</p>',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Skill::insert([
            ['name' => 'Laravel', 'level' => 95, 'category' => 'Backend', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'React', 'level' => 94, 'category' => 'Frontend', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Three.js / R3F', 'level' => 88, 'category' => '3D', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MySQL', 'level' => 90, 'category' => 'Data', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        SceneSetting::create([
            'background_mode' => 'aurora',
            'hero_model_path' => '/models/hero-orb.glb',
            'hero_float_speed' => 0.42,
            'hero_rotation_speed' => 0.18,
            'bloom_intensity' => 0.95,
            'ambient_light_intensity' => 0.75,
            'section_scene_states' => [
                'hero' => ['camera' => [0, 0, 5], 'light' => 0.75],
                'about' => ['camera' => [0.5, 0.3, 4.8], 'light' => 0.7],
                'projects' => ['camera' => [0, -0.2, 4.5], 'light' => 0.8],
            ],
        ]);
    }
}
