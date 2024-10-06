<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// changes
use Illuminate\Foundation\Auth\User as Authenticatable;
// changes

use Laravel\Sanctum\HasApiTokens;

// changes
class Account extends Authenticatable 
// changes
{
    use HasApiTokens, HasFactory, Notifiable;

      /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class, 'account_id');
    }
}
