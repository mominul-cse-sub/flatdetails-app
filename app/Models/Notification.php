<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'is_read', 'event_type', 'path_id', 'created_by', 'read_at','status', 'notification_for'];
}
