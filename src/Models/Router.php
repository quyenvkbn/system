<?php

namespace Quyenvkbn\System\Models;

use Illuminate\Database\Eloquent\Model;

class Router extends Model
{
    protected $fillable = [
        'canonical','table', 'module_id'
    ];
}
