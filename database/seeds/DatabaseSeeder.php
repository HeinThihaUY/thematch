<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 25;
        //
        // for ($i = 0; $i < $limit; $i++) {
        //     DB::table('teams')->insert([
        //         'name' => $faker->company,
        //         'leader' => $i+1,
        //         'matching_status' => rand(1,3),
        //         'team_status' => rand(1,2),
        //         'point' => rand(10,2000),
        //         'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //         'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //     ]);
        // }


        // for ($i = 0; $i < $limit; $i++) {
        //     DB::table('teams')->insert([
        //         'name' => $faker->company,
        //         'leader' => $i+1,
        //         'matching_status' => rand(1,3),
        //         'team_status' => rand(1,2),
        //         'point' => rand(10,2000),
        //         'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //         'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //     ]);
        // }

        // $mem = 0;
        // for ($i = 0; $i < $limit; $i++) {
        //     for ($j =0; $j < 4; $j++){
        //         $mem++;
        //         DB::table('player_invitations')->insert([
        //             'team_id' => $mem,
        //             'player_id' => $i+1,
        //             'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //             'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //         ]);
        //     }
        // }

        // for ($i = 0; $i < 4; $i++) {
        //     DB::table('challenges')->insert([
        //         'name' => $faker->company,
        //         'leader' => $i+1,
        //         'matching_status' => rand(1,3),
        //         'team_status' => rand(1,2),
        //         'point' => rand(10,2000),
        //         'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //         'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //     ]);
        // }

    }
}
