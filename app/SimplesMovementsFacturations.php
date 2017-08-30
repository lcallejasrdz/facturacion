<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SimplesMovementsFacturations extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
            'deleted_at'
        ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'movement',
        'company_emit',
        'bank_emit',
        'company_to',
        'bank_destiny',
        'quantity',
        'final_account',
        'invoice',
        'receipt',
        'status'

    ];
}
