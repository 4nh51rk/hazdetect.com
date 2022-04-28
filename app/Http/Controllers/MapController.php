<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $httpResponse = Http::post(env('THINGSBOARD_URL') . '/api/auth/login', [
            'username' => env('THINGSBOARD_LOGIN'),
            'password' => env('THINGSBOARD_PASSWORD')
        ]);

        // $json = json_decode($httpResponse->body());
        $token = $httpResponse->json('token');

        $httpResponse = Http::withToken($token)
            ->acceptJson()
            ->get(env('THINGSBOARD_URL') . '/api/tenant/devices', [
                'page' => 0,
                'pageSize' => 5000,
                'sortProperty' => "createdTime",
                'sortOrder' => "DESC"
            ]);
        $devices = $httpResponse->json('data');

        foreach ($devices as $key => $device) {
            $entityId = $device['id']['id'];

            $httpResponse = Http::withToken($token)
                ->acceptJson()
                ->get(env('THINGSBOARD_URL') . "/api/plugins/telemetry/DEVICE/$entityId/values/attributes", [
                    'keys' => 'ship'
                ]);

            $devices[$key]['ship'] = ($httpResponse->json(0) != null) ? $httpResponse->json(0)['value'] : '';
        }

        return Inertia::render('Map/Index', [
            'apiKey' => $token,
            'devices' => $devices,
        ]);
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
}
