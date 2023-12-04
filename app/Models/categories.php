<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Specify the table name

    protected $fillable = [
        'name',
        // Add other fields you want to store
    ];
}