<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Relations\MorphToMany;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Get all of the passwords for the user.
     */
    public function passwords_accesses(): MorphToMany
    {
        return $this->morphedByMany(Password::class, 'accessable')->withPivot('access');
    }
    

    public function toggleAccess(string $itemType, int $itemId, int|null $currentAccess): void
    {
      switch ($itemType) {
        case 'password':
          $accessableType = 'App\Models\Password';
          break;
        case 'group':
          $accessableType = 'App\Models\Group';
          break;
      }

      $newAccess = $currentAccess ? 0 : 1;

      DB::table('accessables')
        ->updateOrInsert(
            ['user_id' => $this->id, 'accessable_type' => $accessableType, 'accessable_id' => $itemId],
            ['access' => $newAccess]
        );
    }
}
