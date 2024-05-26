<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // protected $fillable = ['first_name','last_name','address', 'phone', 'membership_id'];
    protected $guarded = [];

    public function membership() {
        return $this->belongsTo('App\Models\Membership');
    }

    public function logbooks()
    {
        return $this->hasMany('App\Models\Logbook');
    }
    
}
