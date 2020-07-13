<?php

namespace Quyenvkbn\System\Models;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    protected $fillable = [
        'canonical', 'routerable_type', 'routerable_id', 'routerable_action'
    ];
}
