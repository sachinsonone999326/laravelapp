<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
   

    public function createClient(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|uuid',
            'email' => 'required|email',
            'phone_number' => 'nullable|string',
            'name' => 'required|string',
            'comment' => 'required|string|max:1000',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create a new client record
        $client = new Client([
            'client_id' => $request->input('client_id'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'name' => $request->input('name'),
            'comment' => $request->input('comment'),
        ]);

        // Save the client record to the database
        $client->save();

        /*$user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => 123456,
        ]);

        $user->save();

        Auth::loginUsingId($user->id);

        $user = Auth::user();
        $factory = JWTFactory::customClaims([
           'exp' => now()->addMinutes(60)->timestamp, // Token expires in 1 hour
        ]);

        $payload = $factory->make(['user' => $user->toArray()]);
        $token = JWTAuth::encode($payload);*/

        // Return a success response
        return response()->json(['message' => 'Client created successfully'], 201);
    }

}
