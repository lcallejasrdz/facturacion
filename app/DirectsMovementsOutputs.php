<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class DirectsMovementsOutputs extends Model
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
        'company',
        'bank_destiny',
        'type',
        'quantity',
        'disperser',
        'bank_origen',
        'comment',
        'receipt'
    ];
}
