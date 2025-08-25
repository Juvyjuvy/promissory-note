<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PromissoryNote extends Model
{
    protected $fillable = [
        'user_id','student_name','student_id','email','gender','department','phone',
        'year_level','amount','reason','term','academic_year','down_payment',
        'due_date','notes','attachments','status','pn_id','archived',
    ];

    protected $casts = [
        'attachments'  => 'array',
        'amount'       => 'decimal:2',
        'down_payment' => 'decimal:2',
        'due_date'     => 'date',
        'archived'     => 'boolean',
    ];

    // RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
