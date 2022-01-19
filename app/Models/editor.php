<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class editor extends Model
{
    use HasFactory;

    public  $table = 'editors';

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];
}
