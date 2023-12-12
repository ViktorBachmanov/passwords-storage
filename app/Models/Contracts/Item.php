<?php

namespace App\Models\Contracts;


interface Item
{
  public function getAccessForUser(int $userId): bool;

  public function toggleAccess(int $userId, bool $currentAccess): void;

  public static function getValidationRules(): array;

  public static function createItem(array $validated): void;
}