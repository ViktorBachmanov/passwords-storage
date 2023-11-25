<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

      Password::create([
        'name' => $validated['name'],
        'value' => Hash::make($validated['value']),
      ])
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
