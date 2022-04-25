<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Models\Device;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ShipController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Ships/Index', [
            'filters' => Request::only('search'),
            'ships' => Ship::withCount('devices')
                ->filter(Request::only('search'))
                ->paginate(15)
                ->withQueryString()
                ->through(fn ($dv) => [
                    'id' => $dv->id,
                    'name' => $dv->name,
                    'imo' => $dv->imo,
                    'ssid' => $dv->ssid,
                    'ssid_password' => $dv->ssid_password,
                    'ipv4' => $dv->ipv4,
                    'wifi_ping' => $dv->wifi_ping,
                    'gsm_ping' => $dv->gsm_ping,
                    'devices_count' => $dv->devices_count,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Ships/Create');
    }

    public function store()
    {
        try {
            Ship::create(
                Request::validate([
                    'name' => ['required'],
                    'imo' => ['nullable'],
                    'ssid' => ['required'],
                    'ssid_password' => ['required'],
                    'ipv4' => ['required'],
                    'wifi_ping' => ['nullable'],
                    'gsm_ping' => ['nullable'],
                ])
            );
        } catch (\Exception $ex) {
            return Redirect::back()->with('error', $ex->getMessage());
        }
        return Redirect::route('dashboard')->with('success', 'Ship Created.');
    }

    public function edit(Ship $ship)
    {
        if ($ship != null) {
            $ship->load('devices');
        }

        return Inertia::render('Ships/Edit', [
            'ship' => $ship,
        ]);
    }

    public function update(Ship $ship)
    {
        try {
            $ship->update(
                Request::validate([
                    'name' => ['required'],
                    'imo' => ['nullable'],
                    'ssid' => ['required'],
                    'ssid_password' => ['required'],
                    'ipv4' => ['required'],
                    'wifi_ping' => ['nullable'],
                    'gsm_ping' => ['nullable'],
                ])
            );
        } catch (\Exception $ex) {
            return Redirect::back()->with('error', $ex->getMessage());
        }
        return Redirect::back()->with('success', 'Ship updated.');
    }

    public function destroy(Ship $ship)
    {
        // $ship->delete();
        $ship->forceDelete();

        return Redirect::route('dashboard')->with('success', 'Ship deleted.');
    }

    public function upload(Ship $ship)
    {
        return Inertia::render('Ships/Upload', [
            'ship' => $ship,
        ]);
    }

    public function uploadStore(Request $request, Ship $ship)
    {

        try {
            $jsonDevices = Request::json()->all();

            foreach ($jsonDevices as $jsonDevice) {
                $device = Device::whereImei($jsonDevice['imei'])->first();
                if ($device == null) {
                    $ship->devices()->create([
                        'container_serial' => $jsonDevice['serial'],
                        'imei' => $jsonDevice['imei'],
                    ]);
                } else {
                    $ship->devices()->save($device);
                }
            }
        } catch (\Exception $e) {
            return Redirect::back()->with('error', [
                'ex' => $e->getMessage(),
            ]);
        }

        // return Redirect::route('dashboard')->with('success', 'Devices mapped to Ship.');
        return Redirect::route('ship.edit',$ship->id)->with('success', 'Devices mapped to Ship.');
    }
}
