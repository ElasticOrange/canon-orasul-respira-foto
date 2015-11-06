<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['photo'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function scopeConfirmed($query)
    {
        $query->where('isActive', '1');
    }

}
