<?php

namespace Modules\Banner\database\seeders;

use Illuminate\Database\Seeder;

class BannerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('banners')->delete();

        $banners = array (
            0 => 
            array (
                'title' => NULL,
                'file_url' => 'the_daring_player_poster.png',
                'poster_url' => 'the_daring_player_thumb.webp',
                'type' => 'movie',
                'type_name' => 'The Daring Player',
                'banner_for' => 'home',
            ),
            1 => 
            array (
                'title' => NULL,
                'file_url' => 'the_smiling_shadows_poster.png',
                'poster_url' => 'the_smiling_shadows_thumb.webp',
                'type' => 'tvshow',
                'type_name' => 'The Smiling Shadows',
                'banner_for' => 'home',
            ),
            2 => 
            array (
                'title' => NULL,
                'file_url' => 'the_gunfighters_redemption_poster.png',
                'poster_url' => 'the_gunfighters_redemption_thumb.webp',
                'type' => 'movie',
                'type_name' => 'The Gunfighter\'s Redemption',
                'banner_for' => 'movie',
            ),
            3 => 
            array (
                'title' => NULL,
                'file_url' => 'daizys_enchanted_journey_poster.png',
                'poster_url' => 'daizys_enchanted_journey_thumb.webp',
                'type' => 'movie',
                'type_name' => 'Daizy\'s Enchanted Journey',
                'banner_for' => 'movie',
            ),
            4 => 
            array (
                'title' => NULL,
                'file_url' => 'seize_your_life.png',
                'poster_url' => 'seize_your_life.png',
                'type' => 'video',
                'type_name' => 'Seize Your Life - Powerful Motivational Speech',
                'banner_for' => 'video',
            ),
            5 => 
            array (
                'title' => NULL,
                'file_url' => 'the_power_of_words_this_story_will_change_your_life.png',
                'poster_url' => 'the_power_of_words_this_story_will_change_your_life.png',
                'type' => 'video',
                'type_name' => 'Life Changing Fitness Habits - Daily Healthy Tips',
                'banner_for' => 'video',
            ),
            6 => 
            array (
                'title' => NULL,
                'file_url' => 'victory_vibes.png',
                'poster_url' => 'victory_vibes.png',
                'type' => 'video',
                'type_name' => 'Victory Vibes',
                'banner_for' => 'home',
            ),
            7 => 
            array (
                'title' => NULL,
                'file_url' => 'veil_of_darkness_thumb.png',
                'poster_url' => 'veil_of_darkness_poster.png',
                'type' => 'tvshow',
                'type_name' => 'Veil of Darkness',
                'banner_for' => 'tv_show',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => NULL,
                'file_url' => 'mcdoll_mayhem_thumb.png',
                'poster_url' => 'mcdoll_mayhem_poster.png',
                'type' => 'tvshow',
                'type_name' => 'McDoll Mayhem',
                'banner_for' => 'tv_show',
            ),
        );

        foreach ($banners as $index => $banner) {
            $typeId = null;
            if ($banner['type'] == 'movie' || $banner['type'] == 'tvshow') {
                $typeId = \DB::table('entertainments')->where('name', $banner['type_name'])->value('id');
            } elseif ($banner['type'] == 'video') {
                $typeId = \DB::table('videos')->where('title', $banner['type_name'])->value('id');
            }

            \DB::table('banners')->insert([
                'id' => $index + 1,
                'title' => $banner['title'],
                'file_url' => $banner['file_url'],
                'poster_url' => $banner['poster_url'],
                'type' => $banner['type'],
                'type_id' => $typeId ?? 0,
                'type_name' => $banner['type_name'],
                'status' => 1,
                'created_by' => 2,
                'updated_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'banner_for' => $banner['banner_for'],
                'poster_tv_url' => $banner['poster_url'],
            ]);
        }

        }

    }


