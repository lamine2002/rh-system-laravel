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
    protected $fillable = [
        'staff_id',
        'team_id',
        'date',
        'start_time',
        'end_time',
        'activity',
        'status',
    ];

    public function team () {
        return Team::query()->where('leader_id', $this->staff_id)->orWhere('supervisor_id', $this->staff_id)->first();
    }
}
