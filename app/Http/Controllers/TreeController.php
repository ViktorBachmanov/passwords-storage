<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\GroupResource;
use App\Models\Group;


class TreeController extends Controller
{
    public function index()
    {
      $groups = GroupResource::collection(Group::getAccessibleGroups(Auth::user()));

      return [
        'groups' => $groups,
        'passwords' => []
      ];
    }
}
