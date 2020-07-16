<?php

namespace Quyenvkbn\System\Models;

use Illuminate\Database\Eloquent\Model;

class CounterValues extends Model
{
	public $timestamps = false; 
	protected $fillable = [
        'id', 'day_id', 'day_value', 'yesterday_id', 'yesterday_value', 'week_id', 'week_value','month_id', 'month_value', 'year_id', 'year_value', 'all_value', 'record_date', 'record_value',
    ];
	protected $table = 'counter_values';
}
