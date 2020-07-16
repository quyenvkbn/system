<?php

namespace Quyenvkbn\System\Models;

use Illuminate\Database\Eloquent\Model;

class CounterIps extends Model
{
	public $timestamps = false;
	protected $fillable = [
        'ip', 'visit', 'session'
    ];
	protected $table = 'counter_ips';
}
