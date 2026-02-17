<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Project;
use App\Models\SceneSetting;
use App\Models\Section;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(['email' => 'admin@example.com'], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        SiteSetting::query()->updateOrCreate(['id' => 1], [
            'site_name' => ['en' => 'Mystic Portfolio', 'fr' => 'Portfolio Mystique', 'ar' => 'ملف أعمال سحري'],
            'tagline' => ['en' => 'Creative technologist', 'fr' => 'Technologue créatif', 'ar' => 'تقني مبدع'],
            'hero_headline' => ['en' => 'Build magical digital products', 'fr' => 'Créer des produits numériques magiques', 'ar' => 'أبني منتجات رقمية ساحرة'],
            'hero_subheadline' => ['en' => '3D, web and storytelling blended together.', 'fr' => '3D, web et narration mélangés.', 'ar' => 'مزيج من ثلاثي الأبعاد والويب والسرد.'],
            'primary_email' => 'hello@example.com',
            'location' => ['en' => 'Remote', 'fr' => 'À distance', 'ar' => 'عن بُعد'],
            'canonical_base_url' => 'http://localhost:8000',
            'seo_title_default' => ['en' => 'Mystic Portfolio', 'fr' => 'Portfolio Mystique', 'ar' => 'ملف أعمال سحري'],
            'seo_description_default' => ['en' => 'SSR portfolio with magical 3D', 'fr' => 'Portfolio SSR avec 3D magique', 'ar' => 'ملف أعمال SSR مع 3D ساحر'],
            'robots_index' => true,
            'robots_follow' => true,
            'social_links' => ['github' => 'https://github.com/example'],
            'theme_default' => 'dark',
            'effects_enabled' => true,
            'effects_intensity' => 70,
        ]);

        collect(['hero','about','skills','projects','experience','contact'])->each(function ($key, $i) {
            Section::query()->updateOrCreate(['key' => $key], [
                'title' => ['en' => ucfirst($key), 'fr' => ucfirst($key), 'ar' => ucfirst($key)],
                'subtitle' => ['en' => 'Section '.$key, 'fr' => 'Section '.$key, 'ar' => 'قسم '.$key],
                'content_html' => ['en' => '<p>English content</p>', 'fr' => '<p>Contenu FR</p>', 'ar' => '<p>محتوى عربي</p>'],
                'sort_order' => $i,
                'is_enabled' => true,
            ]);
        });

        $skills = ['Laravel','React','Three.js','UX','DevOps','SEO'];
        foreach ($skills as $i => $name) {
            Skill::query()->create([
                'name' => ['en' => $name, 'fr' => $name, 'ar' => $name],
                'level' => 60 + $i * 5,
                'category' => ['en' => 'Engineering', 'fr' => 'Ingénierie', 'ar' => 'هندسة'],
                'sort_order' => $i,
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            Experience::query()->create([
                'company' => ['en' => "Company $i", 'fr' => "Entreprise $i", 'ar' => "شركة $i"],
                'role' => ['en' => 'Engineer', 'fr' => 'Ingénieur', 'ar' => 'مهندس'],
                'location' => ['en' => 'Remote', 'fr' => 'À distance', 'ar' => 'عن بُعد'],
                'start_date' => now()->subYears(4 - $i),
                'end_date' => $i === 3 ? null : now()->subYears(3 - $i),
                'description_html' => ['en' => '<p>Impact delivered</p>', 'fr' => '<p>Impact livré</p>', 'ar' => '<p>إنجازات مؤثرة</p>'],
                'sort_order' => $i,
            ]);
        }

        for ($i = 1; $i <= 4; $i++) {
            Project::query()->create([
                'title' => ['en' => "Project $i", 'fr' => "Projet $i", 'ar' => "مشروع $i"],
                'slug' => "project-$i",
                'short_description' => ['en' => 'Short summary', 'fr' => 'Résumé court', 'ar' => 'وصف قصير'],
                'long_description_html' => ['en' => '<p>Detailed story</p>', 'fr' => '<p>Détail</p>', 'ar' => '<p>تفاصيل</p>'],
                'tech_stack' => ['Laravel','React','Three.js'],
                'year' => 2020 + $i,
                'featured' => $i <= 2,
                'sort_order' => $i,
                'model_scale' => 1,
                'model_position' => [0,0,0],
                'model_rotation' => [0,0,0],
                'seo_title' => ['en' => "Project $i SEO", 'fr' => "Projet $i SEO", 'ar' => "سيو مشروع $i"],
                'seo_description' => ['en' => 'Project SEO description', 'fr' => 'Description SEO', 'ar' => 'وصف سيو'],
            ]);
        }

        SceneSetting::query()->updateOrCreate(['id' => 1], [
            'background_mode' => 'aurora',
            'hero_float_speed' => 1.0,
            'hero_rotation_speed' => 0.25,
            'bloom_intensity' => 0.65,
            'ambient_light_intensity' => 1.1,
            'section_scene_states' => [
                'hero' => ['camera' => [0, 0, 6], 'target' => [0, 0, 0], 'light' => 1.2],
                'about' => ['camera' => [1, 0, 5], 'target' => [0, 0, 0], 'light' => 1.0],
                'projects' => ['camera' => [0, 1, 4], 'target' => [0, 0, 0], 'light' => 0.9],
            ],
        ]);
    }
}
