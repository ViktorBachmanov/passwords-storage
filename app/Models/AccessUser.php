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
}
