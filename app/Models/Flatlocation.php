<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flatlocation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','division', 'district', 'thana', 'socity_name', 'road_number', 'block', 'house_number', 'flat_number', 'status'];
}
