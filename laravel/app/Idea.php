<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $table = 'ideas';

    protected $fillable = ['name', 'description', 'modules', 'platform'];

    /**
     * Get the team that sumbited this idea.
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
