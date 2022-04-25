<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    //
    public function getCredentials(Request $request, $imei)
    {
        // return $this->getCredentialsJson($imei);
        return $this->getCredentialsRaw($imei);
    }

    private function getCredentialsJson($imei){
        $data = ['data' => null];
        $device = Device::with('ship')->whereImei($imei)->first();
        if($device != null){
            $data['data'] = [
                'containerSerial' => $device->container_serial,
                'imei' => $device->imei,
                'ship' => [
                    'name' => $device->ship->name,
                    'imo' => $device->ship->imo,
                    'ssid' => $device->ship->ssid,
                    'ssidPassword' => $device->ship->ssid_password,
                    'wifiPing' => $device->ship->wifi_ping,
                    'gsmPing' => $device->ship->gsm_ping,
                ]
            ];
        }
        return response()->json($data,200);
    }

    private function getCredentialsRaw($imei) {

        $device = Device::with('ship')->whereImei($imei)->first();
        if ($device == null || $device->ship == null) {
            // $data = "\$VAL:,,,,#";
            // $chk = 0;
            // $bytes = unpack('C*', $data);
            // for($b =1; $b <= count($bytes); $b++){
            //     $chk = $chk + $bytes[$b];
            // }
            // $chk = 532;
            // $data = "\$VAL:,,,,{$chk}#";
            $data = "success";
        }
        else {
            $data = "\$VAL:{$device->ship->ssid},{$device->ship->ssid_password},{$device->ship->ipv4},{$device->ship->wifi_ping},{$device->ship->gsm_ping},#";
            $chk = 0;
            $bytes = unpack('C*', $data);
            for ($b = 1; $b <= count($bytes); $b++) {
                $chk = $chk + $bytes[$b];
            }
            $data = "\$VAL:{$device->ship->ssid},{$device->ship->ssid_password},{$device->ship->ipv4},{$device->ship->wifi_ping},{$device->ship->gsm_ping},{$chk}#";
        }

        Log::info("IMEI: $imei, Data: $data");
        // return $data;
        return $data . PHP_EOL;
    }

    public function toThingsBoard(Request $request) {

        $json = $request->json()->all();
        Log::info("To ThingsBoard:");
        Log::info($json);

        if(empty($json)) {
            return response('success',200);
        }

        if(!array_key_exists('resource',$json)) {
            return response('successs',200);
        }

        $response = null;
        $responseText = null;
        foreach($json['resource'] as $data){

            $imei = $data['devid'];
            $cred = $this->getCredentialsRaw($imei);
            $responseText = "logid,$cred";
            unset($data['devid']);

            $url = "http://tb.hazdetect.com/api/v1/$imei/telemetry";

            $response = Http::post($url,$data);
        }

        return $response->status() == 200 ? response($responseText,200) : response('successs',200);
    }
}
