<?php


namespace App\Http\Controllers\Admin\Providers;

use App\Http\Requests\Providers\ProvidersHoursRequest;
use App\Models\Hour;
use App\Models\Provider;

class ProvidersHoursController
{
    public function create(ProvidersHoursRequest $request)
    {
        try {
            $data = $request->all();
            $provider = Provider::where('email', $data['email'])
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

    public function index()
    {
        try {
            $hours = Hour::get();
            $hoursMorning = 0;
            $hoursAfternoon = 0;
            $hoursNight = 0;

            foreach ($hours as $hour) {
                if ($hour->period === array_search('morning', config('constants.hourPeriods'))) {
                    $hoursMorning += $hour->value;
                }

                if ($hour->period === array_search('afternoon', config('constants.hourPeriods'))) {
                    $hoursAfternoon += $hour->value;
                }

                if ($hour->period === array_search('night', config('constants.hourPeriods'))) {
                    $hoursNight += $hour->value;
                }
            }

            return response()->json([
                'message' => 'Providers loaded successful',
                'record' => [
                    'total_morning' => $hoursMorning,
                    'total_afternoon' => $hoursAfternoon,
                    'total_night' => $hoursNight
                ]
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'An error has occurred, try again later',
            ], 400);
        }
    }
}
