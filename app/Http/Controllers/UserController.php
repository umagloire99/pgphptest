<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    /**
     * update user information
     * @param Request $request
     * @return JsonResponse
     */
    public function updateComments(Request $request): JsonResponse
    {
        if ($request->acceptsJson()) {
            if (!$request->isJson()) {
                return response()->json('Invalid POST JSON', 422);
            }
        }
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'comments' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 422);
        }

        $id = $request->get('id');
        $password = $request->get('password');
        $comments = $request->get('comments');

        if ($user = User::find($id)) {
            if ($password != config('settings.user_password')) {
                return response()->json('Invalid password', 401);
            }
            $user->comments = $comments;
            try {
                $user->save();
            } catch (Exception $exception) {
                return response()->json('Could not update database: '.$exception->getMessage(), 500);
            }
            return response()->json('ok');
        } else {
            return response()->json("No such user ($id)", 404);
        }
    }
}
