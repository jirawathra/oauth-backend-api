<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{


    // login section
    public function login(Request $request)
    {

        // return 'login';

        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($validated)) {
            // get user object
            $user = User::where('email', $validated['email'])->first();
            // $user = User::all();
            // $user = Auth::user();
            // dd($user);
            // create token
            $token = $user->createToken($user->name);
            // dd($user->name);
            // $token = $user->createToken('access_token');
            // dd($token);
            // $response = [
            //     'data' => [
            //         'user' => $user,
            //         'access_token' => $token,
            //         'status' => 1,
            //         'message' => 'เข้าสู่ระบบสำเร็จ'
            //     ]
            // ];

            // $response = [
            //     'user' => $user,
            //     'access_token' => $token,
            //     'token' => $token->accessToken,
            //     'token-expires-at' => $token->token->expires_at,
            //     'status' => 1,
            //     'message' => 'เข้าสู่ระบบสำเร็จ'
            // ];


            // return response([
            //     'id' => $user->id,
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'created_at' => $user->created_at,
            //     'updated_at' => $user->updated_at,
            //     'token' => $token->accessToken,
            //     'token-expires-at' => $token->token->expires_at,
            //     'status' => 1,
            //     'message' => 'เข้าสู่ระบบสำเร็จ'
            // ], 200);

            $response = [
                'id' => $user->id,
                'firstName' => $user->firstName,
                'lastName' => $user->lastName,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'token' => $token->accessToken,
                'token_expires_at' => $token->token->expires_at,
                'status' => 1,
                'message' => 'เข้าสู่ระบบสำเร็จ'
            ];

            return response()->json($response, 200);
            // return $response;
        } else {
            return response()->json(['message' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!!!'], 401);
            // return response()->json(['message' => 'Unauthenticated!!!'], 401);
        }
    }


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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
