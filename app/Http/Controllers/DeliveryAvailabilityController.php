<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class DeliveryAvailabilityController extends Controller
{
    public function updateAviability(Request $request)
    {
        try {
            abort_unless(
                Auth::user()->tokenCan('Available:update'),
                403,
                'No tienes permisos para realizar esta acción'
            );

            $this->validate($request, [
                'available' => 'required|boolean'
            ]);
            $user = Auth::user();
            $user->config = [
                'available' => $request->available,
                'position' => $user->config['position'] ?? null
            ];

            $user->save();

            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function updateCoordinates(Request $request)
    {
        try {
            abort_unless(
                Auth::user()->tokenCan('Coordinates:update'),
                403,
                'No tienes permisos para realizar esta acción'
            );

            $this->validate($request, [
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric'
            ]);
            $user = Auth::user();

            $user->config = [
                'available' => $user->config['available'] ?? null,
                'position' => [
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude
                ]
            ];
            $user->save();

            return new UserResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
