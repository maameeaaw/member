<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable =  [
        'id',
         'fname',
         'lname',
         'tel',
         'email',
         'address',
         'province',
         'district',
         'code'
 ];
}
