<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $genders = ['male', 'female', 'other'];
        $relationship_status = ['single', 'married', 'complicated'];
        $looking_for = ['friendship', 'dating', 'marriage'];
        $sexual_orientation = ['straight', 'gay', 'bisexual'];
        $education = ['10th', '12th', 'Graduate', 'Post Graduate', 'PhD'];
        $profession = ['Developer', 'Designer', 'Teacher', 'Business', 'None'];
        $religion = ['Hindu', 'Muslim', 'Christian', 'Sikh', 'Other'];
        $caste = ['General', 'OBC', 'SC', 'ST', 'Other'];
        $marital_status = ['Single', 'Married', 'Divorced', 'Widowed'];
        $drink = ['Yes', 'No', 'Occasionally'];
        $smoke = ['Yes', 'No', 'Occasionally'];

        foreach (User::all() as $user) {

            DB::table('profiles')->insert([
                'user_id'              => $user->id,
                'gender'               => $faker->randomElement($genders),
                'age'                  => $faker->numberBetween(18, 45),
                'city'                 => $faker->city,
                'bio'                  => $faker->sentence(12),
                'profile_photo'        => 'default.jpg',

                'relationship_status'  => $faker->randomElement($relationship_status),
                'looking_for'          => $faker->randomElement($looking_for),
                'sexual_orientation'   => $faker->randomElement($sexual_orientation),

                'height'               => $faker->numberBetween(150, 190) . ' cm',
                'weight'               => $faker->numberBetween(45, 95) . ' kg',

                'interests'            => implode(', ', $faker->words(5)),
                'drink'                => $faker->randomElement($drink),
                'smoke'                => $faker->randomElement($smoke),

                'education'            => $faker->randomElement($education),
                'profession'           => $faker->randomElement($profession),

                'religion'             => $faker->randomElement($religion),
                'caste'                => $faker->randomElement($caste),
                'marital_status'       => $faker->randomElement($marital_status),

                'children'             => $faker->numberBetween(0, 2),

                'min_age_pref'         => $faker->numberBetween(18, 25),
                'max_age_pref'         => $faker->numberBetween(26, 40),

                'preferred_city'       => $faker->city,
                'preferred_gender'     => $faker->randomElement($genders),

                'created_at'           => now(),
                'updated_at'           => now(),
            ]);
        }
    }
}
