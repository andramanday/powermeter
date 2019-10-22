<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = (['uid', 'dev', 'dev_loc', 'status', 'cid']);

    public function user() {
		return $this->belongsTo(User::class);
    }
    
    public function sensor() {
		return $this->belongsTo(Sensor::class);
	}
}
