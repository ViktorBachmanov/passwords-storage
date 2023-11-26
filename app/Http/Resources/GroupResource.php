<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

use App\Models\Password;


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

        return [
          'id' => $this->id,
          'name' => $this->name,
          'passwords' => PasswordResource::collection(Password::getGroupAccessiblePasswords($this->id, Auth::user()))
        ];
    }
}
