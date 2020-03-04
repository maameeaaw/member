<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable =  [
        'id',
         'PROVINCE_CODE',
         'PROVINCE_NAME',
 ];
}
