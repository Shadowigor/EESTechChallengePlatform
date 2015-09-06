<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = ['name'];

    /**
     * Get the event that owns the group.
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    /**
     * Get the members that compose this group.
     */
    public function members()
    {
        return $this->belongsToMany('App\Member', 'event_members');
    }
}
