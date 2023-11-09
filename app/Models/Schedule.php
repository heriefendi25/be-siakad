<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function lecturer()
    {
        return $this->hasOneThrough(User::class, Subject::class, 'id', 'id', 'subject_id', 'lecturer_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}