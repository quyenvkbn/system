<?php

namespace Quyenvkbn\System\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Quyenvkbn\System\Requests\UserRequest;
use Quyenvkbn\System\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
	function __construct(){
		$this->authorizeResource(User::class, 'user');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id','DESC');
        if ($request->name) {
            $users->where('name', 'like', "%".$request->name."%");
        }
        return  view('quyenvkbn::user.index', ['users' => $users->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('quyenvkbn::user.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->except('rolesUser'));
        if ($request->rolesUser) {
            $user->syncRoles($request->rolesUser);
        }
        return redirect()->route('user.index')->withSuccess(__('quyenvkbn::system.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        $user->hasAllRoles($roles);
        if ($user->roles) {
            $user->rolesUser = $user->roles->pluck('id')->all();
        }
        return  view('quyenvkbn::user.show', ['roles' => $roles, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
    	$roles = Role::all();
    	$user->hasAllRoles($roles);
    	if ($user->roles) {
    		$user->rolesUser = $user->roles->pluck('id')->all();
    	}
        return  view('quyenvkbn::user.edit', ['roles' => $roles, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->except(['id', 'rolesUser', 'email', 'old_password', 'password_confirmation']));
        if ($request->rolesUser) {
        	$user->syncRoles($request->rolesUser);
        }

        UpdateCKFinderUserRole(auth()->user());

        return redirect()->route('user.index')->withSuccess(__('quyenvkbn::system.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->route('user.index')->withSuccess(__('quyenvkbn::system.delete_success'));
    }
}
