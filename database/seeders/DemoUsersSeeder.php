<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin User
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@demo.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        // Create School (Tenant)
        $school = \App\Models\Tenant::create([
            'name' => 'Demo High School',
            'code' => 'DHS',
            'api_token' => 'demo_api_token_123',
            'status' => 'active',
        ]);

        \App\Models\User::create([
            'name' => 'School Admin',
            'email' => 'admin@demo.com',
            'password' => bcrypt('password'),
            'role' => 'school_admin',
            'school_id' => $school->id,
            'email_verified_at' => now(),
        ]);

        // Create Regular User
        \App\Models\User::create([
            'name' => 'Regular User',
            'email' => 'user@demo.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Create sample competitions
        $competition1 = \App\Models\Competition::create([
            'school_id' => $school->id,
            'code' => 'SPRING2024',
            'name' => 'Spring Athletics Championship 2024',
            'start_date' => now()->addDays(30),
            'end_date' => now()->addDays(32),
            'location' => 'Demo High School Stadium',
            'description' => 'Annual spring athletics championship featuring track and field events.',
            'status' => 'scheduled',
        ]);

        $competition2 = \App\Models\Competition::create([
            'school_id' => $school->id,
            'code' => 'WINTER2024',
            'name' => 'Winter Indoor Track Meet',
            'start_date' => now()->addDays(60),
            'end_date' => now()->addDays(61),
            'location' => 'Indoor Athletics Center',
            'description' => 'Indoor track and field competition for winter season.',
            'status' => 'scheduled',
        ]);

        // Create sample teams
        $team1 = \App\Models\Team::create([
            'school_id' => $school->id,
            'name' => 'Varsity Track Team',
            'description' => 'Senior level track and field team',
        ]);

        $team2 = \App\Models\Team::create([
            'school_id' => $school->id,
            'name' => 'Junior Varsity',
            'description' => 'Junior level athletics team',
        ]);

        // Create sample athletes
        $athlete1 = \App\Models\Athlete::create([
            'team_id' => $team1->id,
            'first_name' => 'John',
            'last_name' => 'Runner',
            'gender' => 'male',
            'dob' => '2005-03-15',
        ]);

        $athlete2 = \App\Models\Athlete::create([
            'team_id' => $team1->id,
            'first_name' => 'Jane',
            'last_name' => 'Sprinter',
            'gender' => 'female',
            'dob' => '2004-07-22',
        ]);

        $athlete3 = \App\Models\Athlete::create([
            'team_id' => $team2->id,
            'first_name' => 'Mike',
            'last_name' => 'Jumper',
            'gender' => 'male',
            'dob' => '2005-11-08',
        ]);

        // Create sample disciplines
        $discipline1 = \App\Models\Discipline::create([
            'competition_id' => $competition1->id,
            'gender' => 'male',
            'category' => '100m Sprint',
            'distance' => '100m',
            'round' => 'final',
            'heat_number' => 1,
            'scheduled_time' => now()->addDays(30)->addHours(10),
        ]);

        $discipline2 = \App\Models\Discipline::create([
            'competition_id' => $competition1->id,
            'gender' => 'female',
            'category' => '200m Sprint',
            'distance' => '200m',
            'round' => 'final',
            'heat_number' => 1,
            'scheduled_time' => now()->addDays(30)->addHours(11),
        ]);

        $discipline3 = \App\Models\Discipline::create([
            'competition_id' => $competition2->id,
            'gender' => 'male',
            'category' => 'Long Jump',
            'distance' => 'N/A',
            'round' => 'final',
            'heat_number' => 1,
            'scheduled_time' => '14:00:00',
        ]);

        // Create sample results
        \App\Models\Result::create([
            'discipline_id' => $discipline1->id,
            'athlete_id' => $athlete1->id,
            'rank' => 1,
            'time' => '10.25',
            'points' => 100,
            'recorded_at' => now(),
        ]);

        \App\Models\Result::create([
            'discipline_id' => $discipline1->id,
            'athlete_id' => $athlete3->id,
            'rank' => 2,
            'time' => '10.45',
            'points' => 80,
            'recorded_at' => now(),
        ]);

        \App\Models\Result::create([
            'discipline_id' => $discipline2->id,
            'athlete_id' => $athlete2->id,
            'rank' => 1,
            'time' => '23.15',
            'points' => 100,
            'recorded_at' => now(),
        ]);
    }
}
