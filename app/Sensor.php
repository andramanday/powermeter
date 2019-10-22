<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'uid', 'cid', 'dev', 'kwh1_ar', 'kwh1_as', 'kwh1_at', 'kwh1_vr', 'kwh1_vs', 'kwh1_vt', 'kwh2_ar', 'kwh2_as', 'kwh2_at', 'kwh2_vr', 'kwh2_vs', 'kwh2_vt'
    ];

    public function device() {
		return $this->belongsTo(Device::class);
	}
}
