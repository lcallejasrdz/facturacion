<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use Redirect;
use Auth;
use Session;
use Carbon\Carbon;
use App\User;
use App\Permissions;
use Datatables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    public function dataindex()
    {
        Carbon::setLocale('es');
        $users = User::where('id', '>', 1)->where('id', '!=', Auth::user()->id)->get(['id', 'name', 'username', 'email', 'created_at']);

        return Datatables::of($users)
            ->edit_column('created_at','{!! \Carbon\Carbon::parse($created_at)->diffForHumans() !!}')
            ->add_column('actions', function($user) {
                $actions = '<a href='. route('users.show', $user->id) .' class="text-info"><i class="fa fa-fw fa-info-circle"></i></a>';
                $actions .= '<a href='. route('users.edit', $user->id) .' class="text-success"><i class="fa fa-fw fa-pencil-square-o"></i></a>';
                $actions .= '<a href="" OnClick="DeleteShow('.$user->id.', \''.$user->name.'\',\'Usuario\',\'users\');" data-toggle="modal" data-target="#deleteModal" class="text-danger"><i class="fa fa-fw fa-minus-square-o"></i></a>';

                return $actions;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permissions::where('id', '>', 1)->lists('name', 'id');

        return view('users.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'permission' => $request->permission
        ]);

        return Redirect::to('users')->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->permission = Permissions::find($user->permission)->name;

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->id == 1)
        {
            $permissions = Permissions::lists('name', 'id');
        }
        else
        {
            $permissions = Permissions::where('id', '>', 1)->lists('name', 'id');
        }
        $user = User::find($id);

        return view('users.edit', compact('permissions', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());

        return Redirect::to('users/'.$user->id)->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        Session::flash('success', 'Usuario eliminado correctamente.');

        return response()->json([
            "message" => "deleted"
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted()
    {
        return view('users.deleted');
    }

    public function datadeleted(Request $request)
    {
        Carbon::setLocale('es');
        $users = User::onlyTrashed()->get();
        return Datatables::of($users)
            ->edit_column('created_at','{!! \Carbon\Carbon::parse($created_at)->diffForHumans() !!}')
            ->edit_column('deleted_at','{!! \Carbon\Carbon::parse($deleted_at)->diffForHumans() !!}')
            ->add_column('actions',function($user) {
                $actions = '<a href="/users/'. $user->id .'/restore" class="text-warning"><i class="fa fa-fw fa-plus-square-o"></i></a>';
                return $actions;
            })
            ->make(true);
    }

    /**
     * Restore a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        $user->restore();

        return Redirect::to('users')->with('success', 'Usuario restaurado correctamente');
    }
}
