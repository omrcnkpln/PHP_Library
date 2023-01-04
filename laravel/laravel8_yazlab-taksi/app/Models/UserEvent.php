<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    use HasFactory;
    protected $table = "user_events";
    protected $fillable = ["user_id", "message", "created_at", "updated_at"];
}
