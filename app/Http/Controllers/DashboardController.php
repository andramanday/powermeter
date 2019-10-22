<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\User;
use App\Sensor;
use App\History;
use Auth;
use View;
use Response;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $tanggal = explode(" ",Carbon::now())[0];
        $tahun = explode("-",$tanggal)[0];
        $bulan = explode("-",$tanggal)[1];

        
        if(Auth::user()->roles[0]->name === 'Super-Admin'){
            $devices = Device::get();
            $online = Sensor::whereDate('updated_at', Carbon::now())->get();
            $price = Sensor::selectRaw('sum(kwh1_cost_r+kwh1_cost_s+kwh1_cost_t+kwh2_cost_r+kwh2_cost_s+kwh2_cost_t) as cost2')
            ->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)
            ->get();

            $datas = Sensor::selectRaw('date(created_at) as created_at, sum(kwh1_cost_r) as kwh1_cost_r, sum(kwh1_cost_s) as kwh1_cost_s, sum(kwh1_cost_t) as kwh1_cost_t, sum(kwh2_cost_r) as kwh2_cost_r, sum(kwh2_cost_s) as kwh2_cost_s, sum(kwh2_cost_t) as kwh2_cost_t')
            ->whereRaw('month(created_at) = '.$bulan.' AND year(created_at) = '.$tahun)
            ->groupby(DB::raw('date(created_at)'))
            ->get();

            $total = History::whereRaw('month(created_at) = '.$bulan.' AND year(created_at) = '.$tahun)->get();
        }else{
            $devices = Device::where('cid', Auth::user()->cid)->get();
            $online = Sensor::whereDate('updated_at', Carbon::now())
            ->where('cid', Auth::user()->cid)->get();
            $price = Sensor::selectRaw('sum(kwh1_cost_r+kwh1_cost_s+kwh1_cost_t+kwh2_cost_r+kwh2_cost_s+kwh2_cost_t) as cost2')
            ->whereRaw('month(updated_at) = '.$bulan.' AND year(updated_at) = '.$tahun.' AND  cid ='.Auth::user()->cid)
            ->get();

            $datas = Sensor::selectRaw('kwh1_cost_r, kwh1_cost_s, kwh1_cost_t, kwh2_cost_r, kwh2_cost_s, kwh2_cost_t, created_at')
            ->whereRaw('month(created_at) = '.$bulan.' AND year(created_at) = '.$tahun.' AND  cid ='.Auth::user()->cid)
            ->get();

            $total = History::whereRaw('month(created_at) = '.$bulan.' AND year(created_at) = '.$tahun.' AND  cid ='.Auth::user()->cid)
            ->get();
        }

        if($request->ajax()){
            return response()->json(['datas' => $datas]);
        }else{
            return view('admin.dashboard.index', compact('devices', 'online', 'price', 'total'));
        }
    }
}
