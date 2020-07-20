<?php

namespace Quyenvkbn\System\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Quyenvkbn\System\Models\Router;

class RouterController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $canonical = str_replace(env('QVSUFFIX', '.html'), '', $request->canonical);
        $router = Router::where(['canonical' => $canonical])->first();
        if(!empty($router)){
            return \App::call(
                $router->routerable_action,
                ['id' => $router->routerable_id, 'canonical' => $canonical]
            );
        }
        abort(404);
    }
}
