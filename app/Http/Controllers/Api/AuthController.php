<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/login",
     * operationId="authLogin",
     * tags={"Authentication"},
     * summary="User Login",
     * description="Login User Here",
     * @OA\RequestBody(
     * @OA\JsonContent(),
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * type="object",
     * required={"email", "password"},
     * @OA\Property(property="email", type="email"),
     * @OA\Property(property="password", type="password")
     * ),
     * ),
     * ),
     * @OA\Response(
     * response=201,
     * description="Login Successfully",
     * @OA\JsonContent()
     * ),
     * @OA\Response(
     * response=422,
     * description="Unprocessable Entity",
     * @OA\JsonContent()
     * ),
     * @OA\Response(response=400, description="Bad request"),
     * @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Coba autentikasi menggunakan logic bawaan Laravel
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah.'
            ], 401); // 401 Unauthorized
        }

        // 3. Jika berhasil, ambil data user
        $user = User::where('email', $request->email)->firstOrFail();

        // 4. Buat token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Kembalikan response sukses dengan token dan data user
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }
}