<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $fillable = [
        'type',
        'title',
        'description',
        'salary',
        'location',
        'company_name',
        'company_description',
        'contact_email',
        'contact_phone',
        'account_id', // Add account_id to fillable
    ];

    // Define the relationship with Account
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // Define the relationship with JobApplication
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}

