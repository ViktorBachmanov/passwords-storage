<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use App\Http\Requests\StorePasswordRequest;
use App\Models\Password;


class PasswordController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Password $password)
    {
        return Crypt::decryptString($password->value);
    }

    
}
