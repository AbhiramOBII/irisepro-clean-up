<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [
            [
                'full_name' => 'Aarav Sharma',
                'email' => 'aarav.sharma@example.com',
                'date_of_birth' => '2005-03-15',
                'gender' => 'male',
                'phone_number' => '+91-9876543210',
                'partner_institution' => 'Delhi Public School',
                'status' => 'active',
                'email_verified_at' => now(),
                'has_seen_welcome' => true
            ],
            [
                'full_name' => 'Priya Patel',
                'email' => 'priya.patel@example.com',
                'date_of_birth' => '2004-07-22',
                'gender' => 'female',
                'phone_number' => '+91-9876543211',
                'partner_institution' => 'Kendriya Vidyalaya',
                'status' => 'active',
                'email_verified_at' => now(),
                'has_seen_welcome' => true
            ],
            [
                'full_name' => 'Arjun Singh',
                'email' => 'arjun.singh@example.com',
                'date_of_birth' => '2005-11-08',
                'gender' => 'male',
                'phone_number' => '+91-9876543212',
                'partner_institution' => 'Ryan International School',
                'status' => 'active',
                'email_verified_at' => now(),
                'has_seen_welcome' => false
            ],
            [
                'full_name' => 'Ananya Gupta',
                'email' => 'ananya.gupta@example.com',
                'date_of_birth' => '2004-12-03',
                'gender' => 'female',
                'phone_number' => '+91-9876543213',
                'partner_institution' => 'DAV Public School',
                'status' => 'active',
                'email_verified_at' => now(),
                'has_seen_welcome' => true
            ],
            [
                'full_name' => 'Rohan Kumar',
                'email' => 'rohan.kumar@example.com',
                'date_of_birth' => '2005-01-18',
                'gender' => 'male',
                'phone_number' => '+91-9876543214',
                'partner_institution' => 'St. Xavier\'s School',
                'status' => 'inactive',
                'email_verified_at' => null,
                'has_seen_welcome' => false
            ],
            [
                'full_name' => 'Kavya Reddy',
                'email' => 'kavya.reddy@example.com',
                'date_of_birth' => '2004-09-25',
                'gender' => 'female',
                'phone_number' => '+91-9876543215',
                'partner_institution' => 'Narayana School',
                'status' => 'active',
                'email_verified_at' => now(),
                'has_seen_welcome' => true
            ],
            [
                'full_name' => 'Vikram Joshi',
                'email' => 'vikram.joshi@example.com',
                'date_of_birth' => '2005-05-12',
                'gender' => 'male',
                'phone_number' => '+91-9876543216',
                'partner_institution' => 'Modern School',
                'status' => 'active',
                'email_verified_at' => now(),
                'has_seen_welcome' => true
            ],
            [
                'full_name' => 'Ishita Agarwal',
                'email' => 'ishita.agarwal@example.com',
                'date_of_birth' => '2004-04-30',
                'gender' => 'female',
                'phone_number' => '+91-9876543217',
                'partner_institution' => 'Amity International School',
                'status' => 'active',
                'email_verified_at' => now(),
                'has_seen_welcome' => false
            ],
            [
                'full_name' => 'Aditya Verma',
                'email' => 'aditya.verma@example.com',
                'date_of_birth' => '2005-08-14',
                'gender' => 'male',
                'phone_number' => '+91-9876543218',
                'partner_institution' => 'Bal Bharati Public School',
                'status' => 'active',
                'email_verified_at' => now(),
                'has_seen_welcome' => true
            ],
            [
                'full_name' => 'Shreya Mishra',
                'email' => 'shreya.mishra@example.com',
                'date_of_birth' => '2004-10-07',
                'gender' => 'female',
                'phone_number' => '+91-9876543219',
                'partner_institution' => 'Lotus Valley International School',
                'status' => 'inactive',
                'email_verified_at' => null,
                'has_seen_welcome' => false
            ]
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
