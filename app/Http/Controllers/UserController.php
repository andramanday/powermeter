<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\{UserUpdateRequest,UserAddRequest};
use Spatie\Permission\Models\Role;
use App;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(User::class, 'index');
        if($request->ajax())
        {
            $users = new User;
            $users = $users->leftJoin('companies', 'users.cid', '=', 'companies.cid');
            // ->select('users.name', 'users.email', 'companies.com_name as cid', 'users.created_at');

            // $role = role::find($users->id);
            // $users->assignRole($role);
            if($request->q)
            {
                $users = $users->where('users.name', 'like', '%'.$request->q.'%')->orWhere('users.email', $request->q);
            }
            if(Auth::user()->roles[0]->name === 'Super-Admin'){
                $users = $users->paginate(config('stisla.perpage'))->appends(['q' => $request->q]);
            }else{
                $users = $users->where('users.cid', '=', Auth::user()->cid)->paginate(config('stisla.perpage'))->appends(['q' => $request->q]);
            }
          
            return response()->json($users);
        }

        if(Auth::user()->roles[0]->name === 'Super-Admin'){
            return view('admin.users.super-admin.index');
        }else{
            return view('admin.users.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->roles[0]->name === 'Super-Admin'){
            return view('admin.users.super-admin.create');
        }else{
            return view('admin.users.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request)
    {
        if(Auth::user()->roles[0]->name === 'Super-Admin'){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'cid' => $request->cid
                ]);
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'cid' => Auth::user()->cid
                ]);
        }
        $role = Role::find($request->role);
        if($role)
        {
            $user->assignRole($role);
        }
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        if(!App::environment('demo'))
        {
            $user->update($request->only([
                'name', 'email'
            ]));

            if($request->password)
            {
                $user->update(['password' => Hash::make($request->password)]);
            }

            if($request->role && $request->user()->can('edit-users') && !$user->isme)
            {
                $role = Role::find($request->role);
                if($role)
                {
                    $user->syncRoles([$role]);
                }
            }
        }

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(!App::environment('demo') && !$user->isme)
        {
            $user->delete();
        } else
        {
            return response()->json(['message' => 'User accounts cannot be deleted in demo mode.'], 400);
        }
    }

    public function roles()
    {
        return response()->json(Role::get());
    }

    public function companies()
    {
        return response()->json(Company::get());
    }

    public function test(request $request)
    {
        $users = new User;
            if($request->q)
            {
                    $users = $users->where('name', 'like', '%'.$request->q.'%')->orWhere('email', $request->q);
                
            }
                $users = $users->paginate(config('stisla.perpage'))->appends(['q' => $request->q]);
      
            return response()->json($users);
    }


    public function roless(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cid' => $request->cid
            ]);
        $role = Role::find($request->role);
        if($role)
        {
            $user->assignRole($role);
        }
        return response()->json($user);
    }
    
}
