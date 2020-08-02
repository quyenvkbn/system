<?php

namespace Quyenvkbn\System\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Quyenvkbn\System\Models\System;
use DB;
use Auth;

class SystemController extends Controller
{
    function __construct(){
        $this->middleware('permission:system-edit', ['only' => ['edit','update']]);
    }

    public function edit($id){
    	$system = System::pluck('content_'.session('locale'), 'keyword')->all();
        return  view('quyenvkbn::system.update', ['system' => get_value_system($system, config('system'), session('locale'))]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$system = System::pluck('keyword')->all();
    	$data_update_and_create = get_update_and_create($system, $request->except(['_token', '_method']), session('locale'));
    	$check = 0;
    	if (!empty($data_update_and_create['create'])) {
    		System::insert($data_update_and_create['create']);
    	}
    	if (!empty($data_update_and_create['update'])) {
    		updateBatch('systems', $data_update_and_create['update'], 'keyword', 'content_'.session('locale'));
    	}
        return redirect()->route('system.edit',1)->withSuccess(__('quyenvkbn::system.update_success'));
    }
}
