<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['photo1', 'photo2', 'photo3', 'photo4', 'photo5', 'descriere'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function getVotesCountAttribute()
    {
        if ( ! array_key_exists('votesCount', $this->relations)) $this->load('votesCount');

        if (is_null($this->getRelation('votesCount')->first())) return 0;

        return $this->getRelation('votesCount')->first()->aggregate;
    }

    public function votesCount() // allows you to eager load
    {
        return $this->votes()
            ->confirmed()
            ->selectRaw('count(*) as aggregate');

    }
}
