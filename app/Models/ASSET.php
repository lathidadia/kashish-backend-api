<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ASSET extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type', 'department', 'registration_date', 'status'
    ];
}
