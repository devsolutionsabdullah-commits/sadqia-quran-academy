<?php

namespace App\Http\Controllers;

class CourseDetailController extends Controller
{
    public function show(string $slug)
    {
        $courses = $this->courseData();

        if (! isset($courses[$slug])) {
            abort(404);
        }

        return view('course-detail', ['course' => $courses[$slug]]);
    }

    private function courseData(): array
    {
        return [
            'nazra-quran' => [
                'name' => 'Nazra Quran',
                'duration' => '12 Months',
                'rate' => 10,
                'who_for' => ['Children', 'Adults', 'Beginners'],
                'outcomes' => ['Read Quran fluently', 'Pronounce correctly', 'Build reading confidence'],
                'outline' => [
                    'Phase 1' => ['Arabic Alphabet', 'Letter Recognition', 'Pronunciation'],
                    'Phase 2' => ['Joining Letters', 'Harakat', 'Word Reading'],
                    'Phase 3' => ['Fluent Reading', 'Short Surahs', 'Daily Practice'],
                    'Phase 4' => ['Complete Quran Reading', 'Revision', 'Assessment'],
                ],
            ],
            'qaida-noorania' => [
                'name' => 'Qaida Noorania',
                'duration' => '3 Months',
                'rate' => 10,
                'who_for' => ['Children', 'Absolute Beginners'],
                'outcomes' => ['Recognize Arabic letters', 'Read basic words', 'Prepare for Nazra Quran'],
                'outline' => [
                    'Week 1-2' => ['Arabic Letters'],
                    'Week 3' => ['Harakat'],
                    'Week 4' => ['Joining'],
                    'Week 5' => ['Words'],
                    'Week 6' => ['Exercises'],
                    'Week 7-12' => ['Complete Qaida'],
                ],
            ],
            'tajweed-rules' => [
                'name' => 'Tajweed Rules',
                'duration' => '3 Months',
                'rate' => 5,
                'who_for' => ['Students who can already read Quran', 'Adults improving recitation'],
                'outcomes' => ['Apply proper Tajweed rules', 'Correct Makharij', 'Recite with confidence'],
                'outline' => [
                    'Topics' => ['Makharij', 'Noon Sakin', 'Meem Sakin', 'Madd', 'Ghunna', 'Qalqalah', 'Practical Reading'],
                ],
            ],
            'daily-duas' => [
                'name' => 'Daily Duas',
                'duration' => '3 Months',
                'rate' => 10,
                'who_for' => ['Children', 'Adults', 'New Muslims'],
                'outcomes' => ['Memorize essential daily duas', 'Understand their meanings', 'Apply them in daily life'],
                'outline' => [
                    'Topics' => ['Morning Duas', 'Evening Duas', 'Eating', 'Sleeping', 'Travel', 'Masjid', 'Parents', 'Protection Duas'],
                ],
            ],
            'islamic-studies' => [
                'name' => 'Islamic Studies',
                'duration' => '6 Months',
                'rate' => 10,
                'who_for' => ['Children', 'Adults', 'New Muslims'],
                'outcomes' => ['Understand core Islamic beliefs', 'Learn key Islamic history', 'Apply Islamic manners daily'],
                'outline' => [
                    'Topics' => ['Pillars of Islam', 'Pillars of Iman', 'Seerah', 'Islamic Manners', 'Prophets', 'Salah', 'Ramadan', 'Zakat', 'Islamic History'],
                ],
            ],
            'hifz-revision' => [
                'name' => 'Hifz Revision',
                'duration' => '12 Months',
                'rate' => 15,
                'who_for' => ['Students who have completed memorization', 'Hifz students needing consistent revision'],
                'outcomes' => ['Retain memorized Quran', 'Strengthen Manzil', 'Stay exam-ready'],
                'outline' => [
                    'Ongoing' => ['Daily Sabaqi', 'Sabqi Revision', 'Manzil', 'Weekly Test', 'Monthly Test'],
                ],
            ],
            'quran-memorization' => [
                'name' => 'Quran Memorization',
                'duration' => '24 Months',
                'rate' => 20,
                'who_for' => ['Dedicated students', 'Children and adults committed to full Hifz'],
                'outcomes' => ['Memorize the complete Quran', 'Build strong retention habits', 'Pass a final examination'],
                'outline' => [
                    'Year 1' => ['Juz 30', 'Juz 29', 'Daily Hifz'],
                    'Year 2' => ['Complete Remaining Juz', 'Intensive Revision', 'Final Examination'],
                ],
            ],
        ];
    }
}