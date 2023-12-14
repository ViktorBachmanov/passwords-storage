<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use App\Enums\Item as ItemEnum;
use App\Http\Requests\StoreItemRequest;


class ItemController extends Controller
{
    /**
     * Store a newly created item in storage.
     */
    public function store(StoreItemRequest $request, string $items)
    {
      $validated = $request->validated();

      $itemClassName = ItemEnum::getMorphMap()[$items];
      $item = $itemClassName::createItem($validated);

      return response()->json(['id' => $item->id], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $items, string $itemId)
    {
      $input = $request->all();

      $itemClassName = ItemEnum::getMorphMap()[$items];

      $itemClassName::find($itemId)->toggleAccess($input['userId'], $input['currentAccess']);
    }
}
