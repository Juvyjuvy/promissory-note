<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromissoryNote extends Model
{
    protected $fillable = [
        'student_name','student_id','gender','department','phone','year_level',
        'amount','reason','term','academic_year','down_payment','due_date','notes','attachments'
    ];

    protected $casts = [
        'attachments' => 'array',
        'due_date' => 'date',
    ];
}

