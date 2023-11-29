<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Contracts\Item;
use App\Models\Traits\Item as ItemTrait;


class Password extends Model implements Item
{
    use HasFactory, ItemTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'hash', 'creator_id', 'group_id'];


    protected static function booted(): void
    {
        static::created(function (Password $password) {
          AccessUser::create([
            'accessable_type' => 'App\Models\Password',
            'accessable_id' => $password->id,
            'user_id' => Auth::user()->id,
            'access' => 1
          ]);
        });
    }

}
