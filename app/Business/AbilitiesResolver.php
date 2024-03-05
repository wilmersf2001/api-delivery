<?php

namespace App\Business;

class AbilitiesResolver
{
  public static function resolve($user, $device)
  {
    if ($user->role === 'client') {
      return match ($device) {
        'watch' => [
          'Establecimiento:show',
          'Ordenes:show',
        ],
        default => [
          'Establecimiento:show',
          'Ordenes:show',
          'Ordenes:store',
          'Producto:show',
          'Cart:manage',
        ]
      };
    }
    if ($user->role === 'delivery') {
      return [
        'Available:update',
        'Coordinates:update',
        'Order:take',
      ];
    }
  }
}
