<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\TenagaPendidik;

class UserController extends Controller
{
    public function searchByName(Request $request): JsonResponse
    {
        $name = $request->query('name');

        if (!$name) {
            return response()->json(['message' => 'Name parameter is missing'], 400);
        }

        $users = User::where('name', 'like', "%{$name}%")->get();
        return response()->json($users);
    }

    public function searchGuruByName(Request $request): JsonResponse
    {
        $name = $request->query('name');
        $periodeId = $request->query('periode_id');

        if (!$name) {
            return response()->json(['message' => 'Name parameter is missing'], 400);
        }

        $query = User::where('name', 'like', "%{$name}%")
            ->where('role', 'guru');

        if ($periodeId) {
            $query->whereDoesntHave('panitiaPpdb', function($q) use ($periodeId) {
                $q->where('id_periode', $periodeId);
            })
            ->whereDoesntHave('bendaharaPpdb', function($q) use ($periodeId) {
                $q->where('id_periode', $periodeId);
            });
        }

        $users = $query->get();
        
        return response()->json($users);
    }
}