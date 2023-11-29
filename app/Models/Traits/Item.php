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

    $accessRecord = $this->users_accesses()
        ->where('user_id', $userId)
        ->firstWhere('accessable_id', $this->id);
 
    if ($accessRecord) {
      return (bool) $accessRecord->pivot->access;
    } 

    return false;
  }

  public function users_accesses(): MorphToMany
  {
      return $this->morphToMany(User::class, 'accessable')->withPivot('access');
  }
}