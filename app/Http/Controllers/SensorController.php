<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sensor;
use App\User;
use App\History;
use Carbon\Carbon;
use App\Device;
use Auth;

class SensorController extends Controller
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
        if(!isset($request->tanggal)){$request->tanggal = Carbon::now();}

        if($request->ajax())
        {
            $sensors = new Device;
            $sensors = $sensors->select('devices.dev_loc','devices.status', 'sensors.*', 'companies.com_name')
            ->leftJoin('sensors', 'sensors.dev', '=', 'devices.dev')
            ->whereDate('sensors.updated_at', $request->tanggal)
            ->leftJoin('companies', 'devices.cid', '=', 'companies.cid');
            if(Auth::user()->roles[0]->name != 'Super-Admin'){
                $sensors = $sensors->where('devices.cid', Auth::user()->cid);
            }
            if($request->q)
            {
                $sensors = $sensors->where('sensors.dev', 'like', '%'.$request->q.'%');
            }
            $sensors = $sensors->paginate(config('stisla.perpage'))->appends(['q' => $request->q]);
            return response()->json($sensors);
        }
        return view('admin.sensors.index');
        // if(!isset($request->total)){$request->total = '10';}
        // if(!isset($request->page)){$request->page = '1';}


        // $sensors = DB::table('sensors')
        //     ->leftJoin('devices', 'sensors.dev', '=', 'devices.dev')
        //     ->select('sensors.*', 'devices.dev_loc as loc')
        //     ->whereDate('sensors.updated_at', '=', $request->tanggal)
        //     ->whereRaw('(sensors.dev like "%'.$request->keyword.'%" OR devices.dev_loc like "%'.$request->keyword.'%")')
        //     ->paginate($request->total)
        //     ->appends($request->only('tanggal'))
        //     ->appends($request->only('keyword'))
        //     ->appends($request->only('total'));


        // return view('admin.sensors.index', compact('sensors', 'request'));

        
            // ->leftJoin('companies', 'devices.cid', '=', 'companies.cid');
            // $sensors = $sensors->join('devices', function ($join) {
            //     $join->on('sensors.dev', '=', 'devices.dev')
            //         ->whereRaw('date(sensors.created_at) = 2019-10-09');
            // });
            // $sensors = $sensors->leftJoin('devices', 'sensors.dev', '=', 'devices.dev');
            // $sensors = $sensors->rightJoin('companies', 'devices.cid', '=', 'companies.cid', '&', 'date(sensors.updated_at)', '=', '2019-10-09');
            // ->orderBy('updated_at', 'desc');
            // ->where( function ( $sensors )
            //     {
            //         $sensors->whereRaw('date(sensors.updated_at) = 2019-10-09');
            //     });
            // ->whereDate('sensors.updated_at', $request->tanggal);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request, $id)
    {
        $datas = History::where('dev', $id);
        $prices = Sensor::selectRaw('sum(kwh1_cost_r) as kwh1_cost_r, sum(kwh1_cost_s) as kwh1_cost_s, sum(kwh1_cost_t) as kwh1_cost_t, sum(kwh2_cost_r) as kwh2_cost_r, sum(kwh2_cost_s) as kwh2_cost_s, sum(kwh2_cost_t) as kwh2_cost_t')
        ->where('dev', $id);
        if(!isset($request->datess)){
            $datas =  $datas->whereMonth('created_at', Carbon::now())->get();
            $prices =  $prices->whereMonth('created_at', Carbon::now())->get();
            $request->total = Carbon::now();
        }else{
            $tahun = explode("-",$request->datess)[0];
            $bulan = explode("-",$request->datess)[1];
            $datas =  $datas->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get();
            $prices =  $prices->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get();
        }
        // var_dump($datas);
        if($request->ajax()){
            return response()->json(['datas' => $datas]);
        }else{
            return view('admin.sensors.detail', compact('datas', 'request', 'prices'));
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
