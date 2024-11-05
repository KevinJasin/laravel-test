<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
    ];

    // Casts to automatically convert attributes to their respective types
    protected $casts = [
        'due_date' => 'datetime',  // Automatically convert due_date to Carbon instance
    ];

    // Optional: Define any relationships here
    // e.g. public function user() { return $this->belongsTo(User::class); }
}
