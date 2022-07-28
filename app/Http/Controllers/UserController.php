<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * show user detail
     * @param $id
     * @return Application|Factory|View|JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('users.view', compact('user'));
        } else {
            return response()->json("No such user ($id)", 404);
        }
    }
}
