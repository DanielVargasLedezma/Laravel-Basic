<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Mail\CodeGen;
use App\Models\User;
use App\Models\Code;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        //
    }

    public function resetPasswordCode($email)
    {
        $user = User::where('email', $email)
            ->first();

        if (!$user) {
            return response([
                'message' => 'No se encontró cuenta alguna con ese email registrado',
            ], 404);
        }

        $code = mt_rand(100000, 999999);

        Code::create([
            'user_id' => $user->id,
            'code' => $code,
        ]);

        CodeGen::sendMail($user, $code);

        return response(null, 201);
    }

    /**
     * Changes the password of the User
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkCode(Request $request, User $user)
    {
        $fields = $request->validate([
            'code' => 'numeric'
        ]);

        $code = Code::where('code', $fields['code']);

        if(!$code)
        {
            return response([
                'message' => 'Wrong code',
            ], 401);
        }

        if($code->user_id === $user->id)
        {
            return response([
                'user' => $user,
            ], 200);
        }
        else
        {
            return response([
                'message' => 'Incorrect user',
            ], 401);
        }
    }
}
