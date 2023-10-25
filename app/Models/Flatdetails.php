<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flatdetails extends Model
{
    use HasFactory;
    protected $fillable = ['flat_id','flat_name','sft', 'bed_room', 'dining_room', 'drawing_room', 'bath_room', 'kitchen_room', 'store_room', 'belkuni', 'status'];
}
