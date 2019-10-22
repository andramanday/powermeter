<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use App\Device;
use App\Sensor;

class CompanyController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(User::class);
    // }
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
            $companies = new Company;
            if($request->q)
            {
                $companies = $companies->where('com_name', 'like', '%'.$request->q.'%')->orWhere('com_location', $request->q);
            }
            $companies = $companies->paginate(config('stisla.perpage'))->appends(['q' => $request->q]);
            return response()->json($companies);
        }
        return view('admin.companies.index');
    }

    public function ambil(Request $request)
    {
        $companies = new Sensor;
        $companies = $companies->paginate(config('stisla.perpage'))->appends(['q' => $request->q]);
        return response()->json($companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'com_name' => 'required|min:3|unique:companies',
            'com_location' => 'required',
            'com_address' => 'required',
            'com_status' => 'required'
        ]);

        Company::create([
            'com_name' => $request->com_name,
            'com_location' => $request->com_location,
            'com_address' => $request->com_address,
            'com_status' => $request->com_status
        ]);

        return response()->json([$request->all()]);
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
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'com_name' => 'required|min:3',
            'com_location' => 'required',
            'com_address' => 'required',
            'com_status' => 'required'
        ]);

        $company->update($request->only([
            'com_name', 'com_location', 'com_address', 'com_status'
        ]));

        return response()->json($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
    }
}
