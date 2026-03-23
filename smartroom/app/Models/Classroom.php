<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'building',
        'floor',
        'capacity',
        'status',
    ];

    protected $attributes = [
        'status' => 'available',
    ];

    // Mock method to get current class
    public function getCurrentClass()
    {
        return null;
    }

    // Mock method to get next class
    public function getNextClass()
    {
        return null;
    }
}
