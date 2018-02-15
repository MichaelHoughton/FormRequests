<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
		'type',
        'address_1',
        'address_2',
		'suburb',
		'post_code',
		'state',
		'country',
    ];

    /**
     * Defines the belongs to relationship to the auditors table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auditor()
    {
        return $this->belongsTo(Auditor::class);
    }
}
