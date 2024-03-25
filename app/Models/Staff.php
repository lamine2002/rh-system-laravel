<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Staff extends Model
{
    use HasFactory;
    protected $guarded = [];

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
        return $this->belongsToMany(Talent::class, 'staff_talent');
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

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function imageUrl(): string
    {
        return Storage::disk('public')->url($this->image);
    }

    public function user()
    {
        // le role se trouve dans la table users qui a l'id de staff
        return $this->belongsTo(User::class, 'staff_id');
    }
}
