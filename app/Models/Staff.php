<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function talents()
    {
        return $this->belongsToMany(Talent::class, 'staff_talent')->withPivot('level');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function mailAlerts()
    {
        return $this->hasMany(MailAlert::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function teamsLed()
    {
        return $this->hasMany(Team::class, 'leader_id');
    }

    public function teamsSupervised()
    {
        return $this->hasMany(Team::class, 'supervisor_id');
    }

    public function chef()
    {
        return $this->belongsTo(Staff::class, 'chef_id');
    }

    public function subordinates()
    {
        return $this->hasMany(Staff::class, 'chef_id');
    }
}
