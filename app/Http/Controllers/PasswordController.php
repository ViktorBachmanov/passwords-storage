<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use App\Http\Requests\StorePasswordRequest;
use App\Models\Password;


class PasswordController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePasswordRequest $request)
    {
      $validated = $request->validated();

      try {
        Password::create([
          'name' => $validated['name'],
          'value' => Crypt::encryptString($validated['value']),
          'hash' => Hash::make($validated['value']),
          'creator_id' => Auth::id(),
          'group_id' => $validated['group_id'],
        ]);
      } catch (\Exception $e) {
        abort(500, 'Password already exists');
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Password $password)
    {
        return Crypt::decryptString($password->value);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
