<?php


namespace App\Http\Controllers\Admin\Providers;

use App\Http\Requests\Providers\ProvidersHoursRequest;
use App\Models\Hour;
use App\Models\Provider;

class ProvidersHoursController
{
    public function create(ProvidersHoursRequest $request, $providerId)
    {
        try {
            $data = $request->all();
            $provider = Provider::where('id', $providerId)
                ->whereNull('deleted_at')
                ->firstOrFail();

            if (
            Hour::where('provider_id', $provider->id)
                ->where('period', $data['period'])
                ->where('date', $data['date'])
                ->first()
            ) {
                abort('400', 'Hour already created');
            }

            $hour = new Hour([
                'value' => (int)$data['value'],
                'period' => array_search($data['period'], config('constants.hourPeriods')),
                'date' => $data['date']
            ]);
            $hour->provider()->associate($provider);

            $hour->save();

            return response()->json([
                'message' => 'Hour created successful'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'An error has occurred, try again later',
            ], 400);
        }
    }
}
