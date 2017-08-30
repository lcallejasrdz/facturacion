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
use App\AdministratorCompanies;
use App\Companies;
use Datatables;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('permissionsUsers');
    }
    
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
        $users = User::where('id', '>', 1)->where('id', '!=', Auth::user()->id)->get(['id', 'name', 'username', 'email', 'permission', 'created_at']);

        foreach($users as $user)
        {
            $user->permission = Permissions::find($user->permission)->name;
        }

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
        $companies = Companies::whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('administrator_companies')
                      ->whereNull('administrator_companies.deleted_at')
                      ->whereRaw('administrator_companies.company = companies.id');
            })
            ->lists('name', 'id');
        $companiesselected[] = null;

        return view('users.create', compact('permissions', 'companies', 'companiesselected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'permission' => $request->permission
        ]);

        // Empresas si es administrador
        if($request->permission == 3)
        {
            foreach($request->companies as $company)
            {
                AdministratorCompanies::create([
                    'user' => $user->id,
                    'company' => $company
                ]);
            }
        }

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
        $user->permissionname = Permissions::find($user->permission)->name;

        $companies = AdministratorCompanies::where('user', $user->id)->get();
        foreach($companies as $company)
        {
            $company->company = Companies::find($company->company)->name;
        }

        return view('users.show', compact('user', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id == 1)
        {
            $permissions = Permissions::lists('name', 'id');
        }
        else
        {
            $permissions = Permissions::where('id', '>', 1)->lists('name', 'id');
        }
        $user = User::find($id);

        $companies = Companies::whereNotExists(function ($query) use ($user) {
                $query->select(DB::raw(1))
                      ->from('administrator_companies')
                      ->whereNull('administrator_companies.deleted_at')
                      ->whereRaw('administrator_companies.user != '.$user->id)
                      ->whereRaw('administrator_companies.company = companies.id');
            })
            ->lists('name', 'id');

        if($user->permission == 3)
        {
            $administratorcompanies = AdministratorCompanies::where('user', $user->id)->get();
            if(count($administratorcompanies) > 0)
            {
                foreach($administratorcompanies as $company)
                {
                    $companiesselected[] = $company->company;
                }
            }
            else
            {
                $companiesselected[] = null;
            }
        }
        else
        {
            $companiesselected[] = null;
        }

        return view('users.edit', compact('permissions', 'user', 'companies', 'companiesselected'));
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

        if($user->permission == 3)
        {
            AdministratorCompanies::where('user', $user->id)->delete();
            if($request->permission == 3)
            {
                foreach($request->companies as $company)
                {
                    AdministratorCompanies::create([
                        'user' => $user->id,
                        'company' => $company
                    ]);
                }
            }
        }

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

        if($user->permission == 3)
        {
            AdministratorCompanies::where('user', $user->id)->delete();
        }

        $user->delete();

        if($user->permission == 3)
        {
            Session::flash('success', 'Usuario eliminado correctamente. Sus empresas fuerón liberadas.');
        }
        else
        {
            Session::flash('success', 'Usuario eliminado correctamente.');
        }

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

    public function datadeleted()
    {
        Carbon::setLocale('es');
        $users = User::onlyTrashed()->get();
        return Datatables::of($users)
            ->edit_column('created_at','{!! \Carbon\Carbon::parse($created_at)->diffForHumans() !!}')
            ->edit_column('deleted_at','{!! \Carbon\Carbon::parse($deleted_at)->diffForHumans() !!}')
            ->add_column('actions', function($user) {
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
        
        if($user->permission == 3)
        {
            return Redirect::to('users')->with('success', 'Usuario restaurado correctamente. Recuerda asignarle empresas a este usuario');
        }
        else{
            return Redirect::to('users')->with('success', 'Usuario restaurado correctamente');
        }
    }
}
