<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function absences()
    {
        return $this->hasManyThrough(Absence::class, Staff::class);
    }

    public function contracts()
    {
        return $this->hasManyThrough(Contract::class, Staff::class);
    }

    public function documents()
    {
        return $this->hasManyThrough(Document::class, Staff::class);
    }

    public function leaves()
    {
        return $this->hasManyThrough(Leave::class, Staff::class);
    }

    public function supervisors()
    {
        return Staff::class->where('id', $this->supervisor_id);
    }

    public function leader()
    {
        return Staff::class->where('id', $this->leader_id);
    }
}
