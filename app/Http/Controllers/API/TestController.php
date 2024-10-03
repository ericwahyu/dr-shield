<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    //
    public function Test(Request $request)
    {
        Log::info($request);
        // hit API MIDTRANS
        $client = new Client();
        $response = $client->request('POST', 'https://hrperuri.burningroom.co.id/api/fingerprint/webhook', [
            json_encode($request),
            // 'headers' => [
            //     'accept' => 'application/json',
            //     'authorization' => 'Basic ' . env('MIDTRANS_KEY_SANDBOX'),
            //     'content-type' => 'application/json',
            // ],
        ]);

        $response = Http::post('https://hrperuri.burningroom.co.id/api/fingerprint/webhook', [
            json_encode($request)
        ]);

        return $response;
    }
}
