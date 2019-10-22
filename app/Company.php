<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $primaryKey = 'cid';
    protected $fillable = (['com_name', 'com_location', 'com_address', 'com_status']);

    public function commentable()
    {
        return $this->morphTo();
    }
}