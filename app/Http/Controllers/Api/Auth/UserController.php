<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request)
    {

        return response()->json([
            'user' => [
                'name' => $request->user()->name,
                'email' => $request->user()->email,
                'role' => $request->user()->getRoleNames()->first(),
            ],
        ]);
    }
}
