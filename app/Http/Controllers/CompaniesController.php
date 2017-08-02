<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CompaniesRequest;
use Redirect;
use Auth;
use Session;
use Carbon\Carbon;
use App\Companies;
use Datatables;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index');
    }

    public function dataindex()
    {
        Carbon::setLocale('es');
        $companies = Companies::get(['id', 'name', 'disperser', 'created_at']);

        return Datatables::of($companies)
            ->edit_column('created_at','{!! \Carbon\Carbon::parse($created_at)->diffForHumans() !!}')
            ->add_column('actions', function($company) {
                $actions = '<a href='. route('companies.show', $company->id) .' class="text-info"><i class="fa fa-fw fa-info-circle"></i></a>';
                $actions .= '<a href='. route('companies.edit', $company->id) .' class="text-success"><i class="fa fa-fw fa-pencil-square-o"></i></a>';
                $actions .= '<a href="" OnClick="DeleteShow('.$company->id.', \''.$company->name.'\',\'Empresa\',\'companies\');" data-toggle="modal" data-target="#deleteModal" class="text-danger"><i class="fa fa-fw fa-minus-square-o"></i></a>';

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
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompaniesRequest $request)
    {
        Companies::create([
            'name' => $request->name,
            'disperser' => $request->disperser
        ]);

        return Redirect::to('companies')->with('success', 'Empresa creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Companies::find($id);

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Companies::find($id);

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompaniesRequest $request, $id)
    {
        $company = Companies::find($id);
        $company->update($request->all());

        return Redirect::to('companies/'.$company->id)->with('success', 'Empresa actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Companies::find($id);

        $company->delete();

        Session::flash('success', 'Empresa eliminada correctamente.');

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
        return view('companies.deleted');
    }

    public function datadeleted(Request $request)
    {
        Carbon::setLocale('es');
        $companies = Companies::onlyTrashed()->get();
        return Datatables::of($companies)
            ->edit_column('created_at','{!! \Carbon\Carbon::parse($created_at)->diffForHumans() !!}')
            ->edit_column('deleted_at','{!! \Carbon\Carbon::parse($deleted_at)->diffForHumans() !!}')
            ->add_column('actions',function($company) {
                $actions = '<a href="/companies/'. $company->id .'/restore" class="text-warning"><i class="fa fa-fw fa-plus-square-o"></i></a>';
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
        $company = Companies::withTrashed()->find($id);

        $company->restore();

        return Redirect::to('companies')->with('success', 'Empresa restaurada correctamente');
    }
}
