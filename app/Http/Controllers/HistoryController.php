<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\History;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize(User::class, 'index');
        if($request->ajax())
        {
            $companies = new History;
            if($request->q)
            {
                $companies = $companies->where('com_name', 'like', '%'.$request->q.'%')->orWhere('com_location', $request->q);
            }
            $companies = $companies->paginate(config('stisla.perpage'))->appends(['q' => $request->q]);
            return response()->json($companies);
        }
        // return view('admin.companies.index');
    }
}
