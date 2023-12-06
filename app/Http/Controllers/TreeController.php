<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\User;


class TreeController extends Controller
{
    public function index(Request $request)
    {
      $user = Auth::user();

      return [
        'groups' => GroupResource::collection(Group::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)),
        'users' => User::where('is_admin', 0)->where('id', '!=', $user->id)->get(),
        'accessForUserId' => $request->input('access_for_user_id')
      ];
    }
}
