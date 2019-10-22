<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use App\Device;
use App\Sensor;
use Carbon\Carbon;

class HistoryapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::where('status', 'subscribe')->get();
        return $devices;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $Msg = '';
        $device = Device::where('dev', $request->dev)->limit(1)->get();
        // return $device[0]->cid;
        if(count($device) === 0)
        {
            $Msg = "Device ".$request->dev." not save in devices table";
        }else{
            // $uid = $device[0]->uid;
            // $cid = $device[0]->cid;
            $request->request->add(['uid' => $device[0]->uid, 'cid' => $device[0]->cid]);
            History::create($request->all());

            $sensor = Sensor::where('dev', $request->dev)->whereDate('created_at', Carbon::now())->get();
            if(count($sensor) === 0)
            {
                Sensor::create($request->all());
                $Msg = "Device ".$request->dev." History Saved & create new Sensor at ".Carbon::now();
            }else{
                Sensor::where('dev', $request->dev)->whereDate('created_at', Carbon::now())
                ->update($request->all());
                $Msg = "Device ".$request->dev." History Saved & Update new Sensor at ".Carbon::now();
            }
        }

        // return response()->json($sensor);

        return $Msg;
    }
/*3
 * Store a newly created resource in storag3.ar    *
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
    public function edit($id)
    {
        //
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

    public function updatedevice(Request $request)
    {
        Device::where('dev', $request->dev)
                ->update($request->only([
                    'status'
                ]));
        return 'new device '.$request->dev.' was '.$request->status;
    }
}
