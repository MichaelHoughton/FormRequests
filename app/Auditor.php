<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auditor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'company',
        'phone',
    ];

    /**
     * Defines the has one relationship to the addresses table
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
