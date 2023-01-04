<?php

namespace App\Models;
//use Vinelab\NeoEloquent\Facade\Neo4jSchema;
//use Vinelab\NeoEloquent\Schema\Blueprint;
//use Vinelab\NeoEloquent\Migrations\Migration;
//use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explorer extends Model
{
//    use HasFactory;
    protected $fillable = ['title', 'year'];
}
