<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    protected $table = 'planning';

//    public function team () {
//        return Team::query()->where('leader_id', $this->staff_id)->orWhere('supervisor_id', $this->staff_id)->first();
//    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getStartTimeAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    public function getEndTimeAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

}
