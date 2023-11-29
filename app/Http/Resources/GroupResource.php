<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

use App\Models\Password;
use App\Models\User;


class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        $userId = $request->input('user_id_access_for');
        if ($userId) {
          $accessForUser = $this->getAccessForUser($userId);
        }

        return [
          'id' => $this->id,
          'name' => $this->name,
          'passwords' => PasswordResource::collection($this->passwords),
          'accessSelf' => $this->getAccessForUser(Auth::id()),
          'access' => [
             'value' => $accessForUser ?? false,
              'display' => Auth::user()->is_admin
          ],
        ];
    }
}
