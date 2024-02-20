<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quardinates extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name',
        'quardinates',
        'email',
        'contact',
        'address',
        'owneradress',
        'note'
    ];
}
