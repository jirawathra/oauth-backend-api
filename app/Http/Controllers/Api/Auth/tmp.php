//login method
    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        // $login = $request->only('email', 'password');
        if (Auth::attempt($validated)) {
            // get user object
            $user = User::where('email', $validated['email'])->first();
            // create token
            // $token = $user->createToken('api_token')->plainTextToken;
            $token = $user->createToken('api_token');
            // return token response
            $response = [
                'data' => [
                    'access_token' => $token
                ]
            ];
            return response()->json($response);
        } else {
            // return response unauthenticated
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
    }   