<?php

namespace App\Models\Contracts;


interface Item
{
  public function getAccessForUser(int $userId): bool;
}