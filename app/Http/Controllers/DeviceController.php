<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\User;
use App\Http\Requests\{DeviceUpdateRequest,DeviceAddRequest};
use Spatie\Permission\Models\Role;
use App;
use Auth;
use Mqtt;

class DeviceController extends Controller
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
            $devices = new Device;
            $devices = $devices->leftJoin('users', 'devices.uid', '=', 'users.id');
            if(Auth::user()->roles[0]->name != 'Super-Admin'){
                $devices = $devices->where('devices.cid', Auth::user()->cid);
            }
            $devices = $devices->Select('devices.id', 'devices.dev', 'devices.dev_loc', 'users.name', 'devices.created_at', 'devices.status');
            
            if($request->q)
            {
                $devices = $devices->where('devices.dev', 'like', '%'.$request->q.'%')->orWhere('devices.dev_loc', $request->q);
            }
            $devices = $devices->paginate(config('stisla.perpage'))->appends(['q' => $request->q]);
            return response()->json($devices);
        }
        return view('admin.devices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {

        $request->validate([
            'dev' => 'required|min:3|unique:devices',
            'dev_loc' => 'required'
        ]);

        Device::create([
            'uid' => Auth::user()->id,
            'dev' => $request->dev,
            'dev_loc' => $request->dev_loc,
            'status' => 'unsubsribe',
            'cid' => Auth::user()->cid
            
        ]);

        // Device::create($request->all());
        // $client_id = Auth::user()->id;
        
        Mqtt::ConnectAndPublish('DEVICE_ADD', $request->dev, Auth::user()->id);

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
    public function edit(Device $device)
    {
        return view('admin.devices.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'dev_loc' => 'required'
        ]);

        $device->update($request->only([
            'dev_loc'
        ]));

        return response()->json($device);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();
    }

    public function sub($dev)
    {
        $output = Mqtt::ConnectAndPublish('DEVICE_ADD', $dev, Auth::user()->id);
        if ($output === true)
        {
            return redirect('admin/devices')->withInfo('status', 'Kontak berhasil ditambahkan');
        }

        return redirect('admin/devices')->withInfo('status', 'Kontak berhasil ditambahkan');
    }

    public function unsub($dev)
    {
        $output = Mqtt::ConnectAndPublish('DEVICE_UNSUB', $dev, Auth::user()->id);
        if ($output === true)
        {
            return redirect('admin/devices')->withInfo('status', 'Kontak berhasil ditambahkan');
        }

        return redirect('admin/devices')->withInfo('status', 'Kontak berhasil ditambahkan');
    }
}
