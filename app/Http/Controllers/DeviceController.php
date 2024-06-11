<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::all();
        return view('device.index', [
            'title' => 'Devices',
            'devices' => $devices

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('device.create', [
            'title' => 'Add Device'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sessionId' => 'required|unique:devices,sessionId',
            'name' => 'required',
            'numberPhone' => 'required|unique:devices,numberPhone',
        ],
            [
                'sessionId.required' => 'The session ID field is required.',
                'sessionId.unique' => 'The session ID has already been taken.',
                'name.required' => 'The name field is required.',
                'numberPhone.required' => 'The phone number field is required.',
                'numberPhone.unique' => 'The phone number has already been taken.',
            ]);

        // store the device
        Device::create([
            'sessionId' => $request->sessionId,
            'name' => $request->name,
            'numberPhone' => $request->numberPhone,
            'status' => 'DISCONNECTED'
        ]);

        // redirect to the devices index page
        return redirect()->route('devices.index')->with('success', 'Device added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        $sessionApiStatus = Http::get(config('whatsapp.api_url') . '/sessions/' . $device->sessionId . '/status');
        $sessionApiStatus = json_decode($sessionApiStatus->body());

        if (isset($sessionApiStatus->error)) {
            if ($sessionApiStatus->error == "Session not found") {
                $device->status = "DISCONNECTED";
                $device->save();
            }
        } else {
            $device->status = $sessionApiStatus->status ?? "DISCONNECTED";
            $device->save();
        }

        if ($device->status == "AUTHENTICATED") {
            $image = asset('img/connect.gif');
            $reloadPage = "";
        } else {
            // Add Session
            $responseAddSession = Http::post(config('whatsapp.api_url') . '/sessions/add', [
                'sessionId' => $device->sessionId,
            ]);
            $res = json_decode($responseAddSession->body());
            if (isset($res->error)) {
                if ($res->error == "Session already exists") {
                    Http::delete(config('whatsapp.api_url') . '/sessions/' . $device->sessionId);
                    $responseAddSession = Http::post(config('whatsapp.api_url') . '/sessions/add', [
                        'sessionId' => $device->sessionId,
                    ]);
                    $res = json_decode($responseAddSession->body());
                }
            }
            $image = $res->qr ?? "";
            $reloadPage = 'setTimeout(function(){window.location.reload(1);}, 20000);';
        }

        return view('device.show', [
            'title' => 'Device Details',
            'device' => $device,
            'image' => $image,
            'reloadPage' => $reloadPage
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        return view('device.edit', [
            'title' => 'Edit Device',
            'device' => $device
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required',
            'numberPhone' => 'required|unique:devices,numberPhone,' . $device->id . ',id',
        ],
            [
                'name.required' => 'The name field is required.',
                'numberPhone.required' => 'The phone number field is required.',
                'numberPhone.unique' => 'The phone number has already been taken.',
            ]);

        $device->update([
            'name' => $request->name,
            'numberPhone' => $request->numberPhone,
        ]);

        return redirect()->route('devices.index')->with('success', 'Device updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $responseDeleteSession = Http::delete(config('whatsapp.api_url') . '/sessions/' . $device->sessionId);
        $res = json_decode($responseDeleteSession->body());
        if (isset($res->message)) {
            if ($res->message == "Session deleted") {
                $device->delete();
                return redirect()->route('devices.index')->with('success', 'Device deleted successfully');
            }
        }
        return redirect()->route('devices.index')->with('error', 'Device not deleted');
    }
}
