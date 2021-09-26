<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(
            User::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $request->validated();
        
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user); 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|unique:users|max:255',
        ]);

        $user->update([
            'name' => $request->input('name'),
        ]);
     
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(null, 204);
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $user = User::where('email', $request->input('email'))
            ->first();

        #    ['password', '=' , bcrypt($request->input('password'))],
        
        
        if(!$user)
        {
            return response([
                'status' => 'error',
                'errorMessage' => 'There is not any user registered with that email',
            ], 401);
        }

        if(!Hash::check($request->input('password'), $user->password))
        {
            return response([
                'status' => 'error',
                'errorMessage' => 'Wrong password',
            ], 401);
        }

        $token = $user->createToken(time())->plainTextToken;

        $response = [
            'data' => new UserResource($user),
            'token' => $token,
        ];

        return response($response, 200);
    }

    public function logout(User $user)
    {
        $user->tokens()->delete();

        return response([
            'status' => 'succeed',
            'message' => 'Logged out'
        ], 200);
    }
}
