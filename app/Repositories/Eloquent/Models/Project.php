<?php

namespace App\Repositories\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = ['id', 'title', 'description', 'status'];
    protected $primaryKey = 'id';
    public $incrementing = false;
}
