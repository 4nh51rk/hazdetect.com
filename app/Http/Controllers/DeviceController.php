<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Ship;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class DeviceController extends Controller
{
  //
  public function index()
  {
    return Inertia::render('Devices/Index', [
      'filters' => Request::only('search'),
      'devices' => Device::with('ship')
        ->filter(Request::only('search'))
        ->paginate(15)
        ->withQueryString()
        ->through(fn ($dv) => [
          'id' => $dv->id,
          'ship_id' => $dv->ship_id,
          'container_serial' => $dv->container_serial,
          'imei' => $dv->imei,
          'ship' => $dv->ship != null ? [
            'name' => $dv->ship->name,
            'ssid' => $dv->ship->ssid,
            'ssid_password' => $dv->ship->ssid_password,
          ] : null,
        ]),
    ]);
  }

  public function create()
  {
    return Inertia::render('Devices/Create', [
      'device' => [],
      'ships' => Ship::select(['id', 'name'])->orderBy('name')->get()->toArray()
    ]);
  }

  public function store()
  {
    try {
      Device::create(
        Request::validate([
          'ship_id' => ['nullable'],
          'container_serial' => ['required'],
          'imei' => ['required'],
        ])
      );
    } catch (\Exception $ex) {
      return Redirect::back()->with('error', $ex->getMessage());
    }


    return Redirect::route('device')->with('success', 'Device Created.');
  }

  public function edit(Device $device)
  {
    if ($device != null) {
      $device->load('ship');
    }

    return Inertia::render('Devices/Edit', [
      'device' => $device,
      'ships' => Ship::select(['id', 'name'])->orderBy('name')->get()->toArray()
    ]);
  }

  public function update(Device $device)
  {
    try {
      $device->update(
        Request::validate([
          'ship_id' => ['nullable'],
          'container_serial' => ['required'],
          'imei' => ['required'],
        ])
      );
    } catch (\Exception $ex) {
      return Redirect::back()->with('error', $ex->getMessage());
    }

    return Redirect::back()->with('success', 'Device Updated.');
  }

  public function destroy(Device $device)
  {
    // $device->delete();
    $device->forceDelete();

    return Redirect::route('device')->with('success', 'Device Deleted.');
  }

  public function upload()
  {
    return Inertia::render('Devices/Upload');
  }

  public function uploadStore(Request $request)
  {

    try {
      $jsonDevices = Request::json()->all();

      foreach ($jsonDevices as $jsonDevice) {
        Device::create([
          'container_serial' => $jsonDevice['serial'],
          'imei' => $jsonDevice['imei'],
        ]);
      }
    } catch (\Exception $ex) {
      return Redirect::back()->with('error', $ex->getMessage());
    }

    return Redirect::route('device')->with('success', 'Devices Uploaded.');
  }
}
