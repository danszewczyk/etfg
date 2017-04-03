<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpAddress extends Model
{
    protected $table = 'ip_addresses';

    protected $fillable = [
        'ip_address', 'city_id', 'state_id', 'country_id', 'postal_code', 'latitude', 'longitude'
    ];
}
