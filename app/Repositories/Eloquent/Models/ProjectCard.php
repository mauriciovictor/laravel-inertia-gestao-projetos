<?php

namespace App\Repositories\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCard extends Model
{
    protected $table = 'projects_cards';
    protected $fillable = ['project_id', 'title', 'color', 'description'];

    public function items()
    {
        return $this->hasMany(ProjectCardItem::class, 'project_card_id');
    }
}
