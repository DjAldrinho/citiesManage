<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'code',
    ];

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }
}
