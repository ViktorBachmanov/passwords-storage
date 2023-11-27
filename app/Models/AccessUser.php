<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class AccessUser extends MorphPivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accessables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['accessable_type', 'accessable_id', 'user_id', 'access'];
}
