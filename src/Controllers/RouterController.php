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
        $router = Router::where(['canonical' => $request->canonical])->first();
        if(!empty($router)){
            return \App::call(
                $router->routerable_action,
                ['id' => $router->routerable_id, 'canonical' => $request->canonical]
            );
        }
        abort(404);
    }
}
