<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


class PasswordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        if ($userId = $request->input('access_for_user_id')) {
          $passwordAccess = User::find($userId)->passwords_accesses()->firstWhere('accessable_id', $this->id);
        }

        return [
          'id' => $this->id,
          'name' => $this->name,
          'access' => [
            'value' => isset($passwordAccess)
               ? $passwordAccess->pivot->access
               : null,
             'display' => Auth::user()->is_admin || Auth::user()->isCreatorOfPassword($this->id)
          ],
        ];
    }
}
