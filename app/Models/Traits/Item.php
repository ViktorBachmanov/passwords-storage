<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

use App\Models\User;


trait Item
{
  public function getAccessForUser(int $userId): bool
  {
    if (User::find($userId)->is_admin || $this->name == 'root_group') {
      return true;
    }

    $accessRecord = $this->users()->firstWhere('user_id', $userId);
        
    if ($accessRecord) {
      return (bool) $accessRecord->pivot->access;
    } 

    return false;
  }

  public function toggleAccess(int $userId, bool $currentAccess): void
  {
    $newAccess = $currentAccess ? 0 : 1;

    $affectedRows = $this->users()->updateExistingPivot($userId, [
      'access' => $newAccess,
    ]);

    if ($affectedRows == 0) {
      $this->createAccess($userId);
    }
  }

  public function createAccess(int $userId): void
  {
    $this->users()->attach($userId, ['access' => 1]);
  }

  private function users(): MorphToMany
  {
      return $this->morphToMany(User::class, 'accessable')->withPivot('access');
  }
}