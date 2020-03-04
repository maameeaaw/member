<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable =  [
        'DISTRICT_ID',
             'DISTRICT_CODE',
             'DISTRICT_NAME',
             'POSTCODE',
             'GEO_ID',
            'PROVINCE_ID'
     ];
}
