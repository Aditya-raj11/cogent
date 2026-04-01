<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MobileSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

      if(env('IS_DUMMY_DATA')==false){


            \DB::table('mobile_settings')->delete();

        \DB::table('mobile_settings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Banner',
                'slug' => 'banner',
                'position' => 1,
                'value' => '1',
                'created_at' => '2024-07-12 10:28:06',
                'updated_at' => '2024-07-12 10:28:06',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Continue Watching',
                'slug' => 'continue-watching',
                'position' => 2,
                'value' => '1',
                'created_at' => '2024-07-12 10:28:21',
                'updated_at' => '2024-07-12 10:28:21',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Top 10',
                'slug' => 'top-10',
                'position' => 3,
                'value' => null,
                'created_at' => '2024-07-12 10:28:33',
                'updated_at' => '2024-07-12 10:43:17',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Advertisement',
                'slug' => 'advertisement',
                'position' => 4,
                'value' => '1',
                'created_at' => '2024-07-12 10:28:47',
                'updated_at' => '2024-07-12 10:28:47',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Latest Movies',
                'slug' => 'latest-movies',
                'position' => 5,
                'value' => null,
                'created_at' => '2024-07-12 10:29:02',
                'updated_at' => '2024-07-12 10:44:11',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Popular language',
                'slug' => 'enjoy-in-your-native-tongue',
                'position' => 6,
                'value' => null,
                'created_at' => '2024-07-12 10:29:20',
                'updated_at' => '2024-07-12 10:33:08',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Popular Movies',
                'slug' => 'popular-movies',
                'position' => 7,
                'value' => null,
                'created_at' => '2024-07-12 10:29:36',
                'updated_at' => '2024-07-12 10:48:33',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Top Channels',
                'slug' => 'top-channels',
                'position' => 8,
                'value' => null,
                'created_at' => '2024-07-12 10:30:54',
                'updated_at' => '2024-07-12 10:30:54',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Popular Personalities',
                'slug' => 'your-favorite-personality',
                'position' => 9,
                'value' => null,
                'created_at' => '2024-07-12 10:31:08',
                'updated_at' => '2024-07-12 10:47:13',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Free Movies',
                'slug' => '500-free-movies',
                'position' => 10,
                'value' => null,
                'created_at' => '2024-07-12 10:31:38',
                'updated_at' => '2024-07-12 10:47:34',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Genres',
                'slug' => 'genre',
                'position' => 11,
                'value' => null,
                'created_at' => '2024-07-12 10:31:52',
                'updated_at' => '2024-07-12 10:49:42',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Rate our app',
                'slug' => 'rate-our-app',
                'position' => 12,
                'value' => '1',
                'created_at' => '2024-07-12 10:32:08',
                'updated_at' => '2024-07-12 10:32:08',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Popular TV Show',
                'slug' => 'popular-tvshows',
                'position' => 13,
                'value' => null,
                'created_at' => '2024-07-12 10:29:36',
                'updated_at' => '2024-07-12 10:48:33',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Popular Videos',
                'slug' => 'popular-videos',
                'position' => 14,
                'value' => null,
                'created_at' => '2024-07-12 10:29:36',
                'updated_at' => '2024-07-12 10:48:33',
                'deleted_at' => NULL,
            ),
        ));

      }else{





        \DB::table('mobile_settings')->delete();

        $movieIds = \DB::table('entertainments')->where('type', 'movie')->pluck('id')->toArray();
        $tvShowIds = \DB::table('entertainments')->where('type', 'tvshow')->pluck('id')->toArray();
        $videoIds = \DB::table('videos')->pluck('id')->toArray();
        $genreIds = \DB::table('genres')->pluck('id')->toArray();
        $castIds = \DB::table('cast_crews')->pluck('id')->toArray();
        $channelIds = \DB::table('live_tv_channels')->pluck('id')->toArray();
        $languageIds = \DB::table('constants')->where('type', 'movie_language')->pluck('id')->toArray();

        \DB::table('mobile_settings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Banner',
                'slug' => 'banner',
                'position' => 1,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Continue Watching',
                'slug' => 'continue-watching',
                'position' => 2,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Top 10',
                'slug' => 'top-10',
                'position' => 3,
                'value' => json_encode(array_slice($movieIds, 0, 10)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Advertisement',
                'slug' => 'advertisement',
                'position' => 4,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Latest Movies',
                'slug' => 'latest-movies',
                'position' => 5,
                'value' => json_encode(array_slice($movieIds, 0, 8)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Popular language',
                'slug' => 'enjoy-in-your-native-tongue',
                'position' => 6,
                'value' => json_encode(array_slice($languageIds, 0, 8)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Popular Movies',
                'slug' => 'popular-movies',
                'position' => 7,
                'value' => json_encode(array_slice($movieIds, 0, 11)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Top Channels',
                'slug' => 'top-channels',
                'position' => 8,
                'value' => json_encode(array_slice($channelIds, 0, 10)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Popular Personalities',
                'slug' => 'your-favorite-personality',
                'position' => 9,
                'value' => json_encode(array_slice($castIds, 0, 10)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Free Movies',
                'slug' => '500-free-movies',
                'position' => 10,
                'value' => json_encode(array_slice($movieIds, 0, 10)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Genres',
                'slug' => 'genre',
                'position' => 11,
                'value' => json_encode(array_slice($genreIds, 0, 8)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Rate our app',
                'slug' => 'rate-our-app',
                'position' => 12,
                'value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Popular TV Show',
                'slug' => 'popular-tvshows',
                'position' => 13,
                'value' => json_encode(array_slice($tvShowIds, 0, 8)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Popular Videos',
                'slug' => 'popular-videos',
                'position' => 14,
                'value' => json_encode(array_slice($videoIds, 0, 10)),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => NULL,
            ),
        ));

      }


    }
}
