<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubAttribute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_id',
        'subattribute_name',
        'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the attribute that owns the sub-attribute.
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
