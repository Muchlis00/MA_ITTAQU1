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

        if (!$name) {
            return response()->json(['message' => 'Name parameter is missing'], 400);
        }

        $users = User::where('name', 'like', "%{$name}%")
            ->where('role', 'guru')
            ->get();
        return response()->json($users);
    }
}
