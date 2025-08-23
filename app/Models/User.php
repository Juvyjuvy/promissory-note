<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;



    // Custom primary key
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';
public function getDisplayNameAttribute()
{
    return $this->fullname ?? $this->name ?? strtok($this->email, '@');
}

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'role',
        'course',
        'year_level',
        'college',
        'gender',
        'submission_count',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    }

