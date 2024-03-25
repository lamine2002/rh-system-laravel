<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'staff_talent', 'talent_id', 'staff_id');
    }

    public function talentType()
    {
        return $this->belongsTo(TalentType::class);
    }

}
