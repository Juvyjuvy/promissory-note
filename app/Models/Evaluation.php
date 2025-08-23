<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';
    protected $primaryKey = 'evaluation_id';

    protected $fillable = [
        'pn_id',
        'evaluator_id',
        'decision',    // 'approved' | 'rejected'
        'reason',
        'evaluated_at',
    ];

    protected $casts = [
        'evaluated_at' => 'datetime',
    ];

    // Relationships
    public function note()
    {
        // promissory_notes.pn_id (PK) ↔ evaluations.pn_id (FK)
        return $this->belongsTo(PromissoryNote::class, 'pn_id', 'pn_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
