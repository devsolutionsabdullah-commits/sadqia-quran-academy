<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'qualifications',
    'experience_years',
    'bio',
    'meeting_link',
    'photo_path',
    'languages',
    'specialization',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}