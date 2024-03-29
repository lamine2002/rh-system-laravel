<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function talents()
    {
        return $this->hasMany(Talent::class);
    }


}
