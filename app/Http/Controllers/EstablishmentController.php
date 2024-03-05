<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Http\Resources\EstablishmentResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    public function index()
    {
        abort_unless(
            Auth::user()->tokenCan('Establecimiento:show'),
            403,
            'No tienes permisos para listar establecimientos'
        );
        $establishments = Establishment::when(request('category'), function ($query, $category) {
            return $query->where('category', $category);
        })
            ->when(request()->exists('popular'), function ($query) {
                return $query->where('stars', '>=', 4);
            })
            /* ->with('products') SI LE PONGO ESTO AÑADIRA LOS PRODUCTOS QUE TIENEN LOS ESTABLECIMIENTOS*/
            ->paginate(10);
        return EstablishmentResource::collection($establishments);
    }

    public function show(Establishment $establishment)
    {
        abort_unless(
            Auth::user()->tokenCan('Establecimiento:show'),
            403,
            'No tienes permisos para listar establecimientos'
        );
        $establishment->load('products');
        return new EstablishmentResource($establishment);
    }
}
