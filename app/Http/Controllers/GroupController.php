<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreGroupRequest;
// use App\Http\Resources\GroupResource;
use App\Models\Group;


class GroupController extends Controller
{
    // public function index()
    // {
    //   return GroupResource::collection(Group::getAccessibleGroups(Auth::user()));
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
      $validated = $request->validated();

      Group::create([
        'name' => $validated['name'],
      ]);
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
