<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

// use App\Models\Contracts\Item;
// use App\Models\Group;
// use App\Models\Password;


class ItemController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $itemClassName, string $itemId)
    {
      $input = $request->all();

      $className = match ($itemClassName) {
        'group' => 'App\Models\Group',
        'password' => 'App\Models\Password',
      };

      $className::find($itemId)->toggleAccess($input['userId'], $input['currentAccess']);
    }
}
