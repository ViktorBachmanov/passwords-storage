<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Group;
use App\Models\User;


class UserController extends Controller
{
  public function index()
  {
    return User::all()->map(fn ($user) => [
      'label' => $user->email,
      'value' => $user->email,
    ]);
  }
}
