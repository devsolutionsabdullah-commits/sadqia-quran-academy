<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'amount',
        'status',
        'due_date',
        'paid_date',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'paid_date' => 'date',
        ];
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}