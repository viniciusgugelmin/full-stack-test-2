<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    protected $fillable = [
        'name',
        'email'
    ];

    protected $appends = [
        'total_hours',
        'total_morning',
        'total_afternoon',
        'total_night'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    /// Relations

    public function hours()
    {
        return $this->hasMany(Hour::class, 'provider_id');
    }

    /// Getters

    public function getTotalHoursAttribute()
    {
        $total = 0;
        $hours = $this
            ->hours()
            ->get();

        foreach ($hours as $hour) {
            $total += $hour->value;
        }

        return $total;
    }

    public function getTotalMorningAttribute()
    {
        $total = 0;
        $hours = $this
            ->hours()
            ->where('period', array_search('morning', config('constants.hourPeriods')))
            ->get();

        foreach ($hours as $hour) {
            $total += $hour->value;
        }

        return $total;
    }

    public function getTotalAfternoonAttribute()
    {
        $total = 0;
        $hours = $this
            ->hours()
            ->where('period', array_search('afternoon', config('constants.hourPeriods')))
            ->get();

        foreach ($hours as $hour) {
            $total += $hour->value;
        }

        return $total;
    }

    public function getTotalNightAttribute()
    {
        $total = 0;
        $hours = $this
            ->hours()
            ->where('period', array_search('night', config('constants.hourPeriods')))
            ->get();

        foreach ($hours as $hour) {
            $total += $hour->value;
        }

        return $total;
    }
}
