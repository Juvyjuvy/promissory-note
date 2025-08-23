<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromissoryNote extends Model
{
    protected $table = 'promissory_notes';
protected $primaryKey = 'pn_id';
protected $fillable = [
    'user_id', 'student_name', 'student_id', 'gender', 'department', 'phone',
    'year_level', 'amount', 'reason', 'term', 'academic_year', 'down_payment',
    'due_date', 'notes', 'attachments', 'status',
];
protected $casts = [
    'attachments' => 'array',
    'due_date' => 'date',
    'amount' => 'decimal:2',
    'down_payment' => 'decimal:2',
];
public function getRouteKeyName(): string { return 'pn_id'; }

// link to User
public function user() { return $this->belongsTo(\App\Models\User::class, 'user_id'); }

// link to evaluations
public function evaluations() { return $this->hasMany(\App\Models\Evaluation::class, 'pn_id', 'pn_id'); }
}
