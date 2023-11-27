<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\AccessUser;


class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    protected static function booted(): void
    {
        static::created(function (Group $group) {
          $user = Auth::user();
          if (!$user) {
            return;
          }

          AccessUser::create([
            'accessable_type' => 'App\Models\Group',
            'accessable_id' => $group->id,
            'user_id' => $user->id,
            'access' => 1
          ]);
        });
    }

}
