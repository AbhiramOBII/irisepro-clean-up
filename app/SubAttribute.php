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
     * Get the attribute that owns the sub-attribute.
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
