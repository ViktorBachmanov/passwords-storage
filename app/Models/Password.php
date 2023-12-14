<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\Contracts\Item;
use App\Models\Traits\Item as ItemTrait;
use App\Enums\Item as ItemEnum;


class Password extends Model implements Item
{
    use HasFactory, ItemTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'hash', 'creator_id', 'group_id'];


    public static function getValidationRules(): array
    {
        return [
          'name' => 'required',
          'value' => 'required|min:8',
          'group_id' => 'required'
        ];
    }

    public static function createItem(array $validated): Item
    {
        try {
            return Password::create([
              'name' => $validated['name'],
              'value' => Crypt::encryptString($validated['value']),
              'hash' => Hash::make($validated['value']),
              'creator_id' => Auth::id(),
              'group_id' => $validated['group_id'],
            ]);
         } catch (\Exception $e) {
            abort(409, 'Password already exists');
        }
    }

}
