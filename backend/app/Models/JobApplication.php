<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'account_id', 
        'name',
        'email',
        'phone',
        'resume',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'job_id');
    }
}

