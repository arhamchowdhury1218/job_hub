<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

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
    ];
}
