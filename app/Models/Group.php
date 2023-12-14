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
use App\Enums\Item as ItemEnum;


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

    public static function getValidationRules(): array
    {
        return [
          'name' => 'required',
        ];
    }

    public static function createItem(array $validated): void
    {
        try {
            self::create([
              'name' => $validated['name'],
            ]);
        } catch (\Exception $e) {
            abort(409, 'Group already exists');
        }
    }

}
