<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Password extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'creator_id', 'group_id'];


    public static function getGroupAccessiblePasswords(int $groupId, User $user)
    {
      return DB::select('select * from passwords where group_id = ?', [$groupId]);
    }
}
