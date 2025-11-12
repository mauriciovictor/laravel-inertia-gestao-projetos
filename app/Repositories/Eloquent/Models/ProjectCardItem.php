<?php

namespace App\Repositories\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCardItem extends Model
{
    protected $table = 'projects_cards_items';
    protected $fillable = ['project_card_id', 'title', 'description', 'priority'];
}
