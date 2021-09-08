<?php


namespace App\Http\Controllers\Admin\Providers;

use App\Http\Requests\Providers\ProvidersRequest;
use App\Models\Provider;

class ProvidersController
{
    public function create(ProvidersRequest $request)
    {
        try {
            $data = $request->all();

            $provider = Provider::create([
                "name" => $data['name'],
                "email" => $data['email']
            ]);

            return response()->json([
                'message' => 'Provider created successful',
                'record' => $provider
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'An error has occurred, try again later',
            ], 400);
        }
    }
}
