<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the local_governments for the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function local_governments()
    {
        return $this->hasMany(LocalGovernment::class);
    }

}
