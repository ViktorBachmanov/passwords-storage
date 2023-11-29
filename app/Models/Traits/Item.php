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

    $accessRecord = $this->users_accesses()->firstWhere('user_id', $userId);
 
    if ($accessRecord) {
      return (bool) $accessRecord->pivot->get('access');
    } 

    return false;
  }

  private function users_accesses(): MorphToMany
  {
      return $this->morphToMany(User::class, 'accessable')->withPivot('access');
  }
}