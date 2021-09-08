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

    protected $casts = [
        'id' => 'integer',
    ];

    /// Relations

    public function hours()
    {
        return $this->hasMany(Hour::class, 'provider_id');
    }
}
