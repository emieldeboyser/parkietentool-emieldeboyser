<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ring extends Model
{
    use HasFactory;
    protected $table = 'rings'; // Name of the database table
    
    protected $fillable = [
        'type_id',
        'name',
        // Add other fillable columns here
    ];
}
