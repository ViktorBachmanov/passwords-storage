<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\User;
use App\Models\AccessUser;
use App\Models\Password;
use App\Models\Contracts\Item;
use App\Models\Traits\Item as ItemTrait;


class Group extends Model implements Item
{
    use HasFactory, ItemTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * Get the passwords for the group.
     */
    public function passwords(): HasMany
    {
      return $this->hasMany(Password::class);
    }


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
