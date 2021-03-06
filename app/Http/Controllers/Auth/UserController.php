<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\InteresController as interes;

class UserController extends Controller
{
    /**
     * Get authenticated user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request)
    {
        return response()->json($request->user());
    }

    public function store(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                
                $request['password'] = bcrypt($request['password']);
                $model = new User();
                event(new Registered($user = $model->create($request->all())));

                if (count($request['intereses']) > 0) {
                    $controller = new interes;
                    $controller->store($request['intereses'], $user);
                }

                return response([ 'mensaje' => 'registro exitoso', 'usuario'=> $user ], 201);
                
            });
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
