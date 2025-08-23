<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    // Table name defaults to "evaluations"
    protected $primaryKey = 'evaluation_id';
    protected $fillable = ['pn_id', 'evaluator_id', 'decision', 'reason', 'evaluated_at'];
    protected $casts = ['evaluated_at' => 'datetime'];

    public function note()
    {
        return $this->belongsTo(PromissoryNote::class, 'pn_id', 'pn_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
