<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    protected $table = 'hours';

    protected $fillable = [
        'value',
        'period',
        'date'
    ];

    protected $appends = [
        'provider',
        'period_name'
    ];

    protected $casts = [
        'id' => 'integer'
    ];

    /// Relations

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    /// Getters

    public function getPeriodNameAttribute() {
        return config('constants.hourPeriods')[$this->period];
    }
}
