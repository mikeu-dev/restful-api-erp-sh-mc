<?php

namespace App\Modules\Auth\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Auth\DTOs\LoginRequestDto;
use App\Modules\Auth\DTOs\RegisterRequestDto;
use App\Modules\Auth\Service\AuthService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API ERP SH",
 *     description="API Enterprice Resource Planning Software House"
 * )
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 */
class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="User login",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="secret123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="access_token", type="string"),
     *                 @OA\Property(property="refresh_token", type="string", nullable=true),
     *                 @OA\Property(property="expires_in", type="integer", example=3600),
     *                 @OA\Property(property="token_type", type="string", example="Bearer"),
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="string"),
     *                     @OA\Property(property="email", type="string", example="user@example.com")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Login successful")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="data",  type="string", example="Login failed, invalid credentials"),
     *             @OA\Property(property="message", type="string", example="Validation Failed")
     *         )
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */

    public function login(Request $request)
    {
        $dto = new LoginRequestDto($request->only('email', 'password'));
        return $this->authService->login($dto);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/register",
     *     summary="User registration",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","username","password","password_confirmation"},
     *             @OA\Property(property="name", type="string", example="string"),
     *             @OA\Property(property="email", type="string", format="email", example="test@example.com"),
     *             @OA\Property(property="username", type="string", example="test123"),
     *             @OA\Property(property="password", type="string", format="password", example="secret123"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="secret123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Register successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="access_token", type="string"),
     *                 @OA\Property(property="refresh_token", type="string", nullable=true),
     *                 @OA\Property(property="expires_in", type="integer", example=3600),
     *                 @OA\Property(property="token_type", type="string", example="Bearer"),
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="string"),
     *                     @OA\Property(property="email", type="string", example="user@example.com")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Register successful")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Validation Failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="data", type="string", example="Confirm password not match"),
     *             @OA\Property(property="message", type="string", example="Validation Failed")
     *         )
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function register(Request $request)
    {
        $dto = new RegisterRequestDto($request->only('name', 'email', 'username', 'password', 'password_confirmation'));
        return $this->authService->register($dto);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/logout",
     *     summary="User logout",
     *     tags={"Authentication"},
     *     @OA\Response(
     *          response=200,
     *          description="Logout successful",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="null", example="null"),
     *             @OA\Property(property="message", type="string", example="Logout success")
     *         )
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Authorized",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="data", type="null", example="null"),
     *             @OA\Property(property="message", type="string", example="The token could not be parsed from the request")
     *         )
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function logout()
    {
        return $this->authService->logout();
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/refresh",
     *     summary="Refresh JWT token",
     *     tags={"Authentication"},
     *    @OA\Response(
     *         response=200,
     *         description="Token refreshed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="access_token", type="string"),
     *                 @OA\Property(property="refresh_token", type="string", nullable=true),
     *                 @OA\Property(property="expires_in", type="integer", example=3600),
     *                 @OA\Property(property="token_type", type="string", example="Bearer"),
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="string"),
     *                     @OA\Property(property="email", type="string", example="user@example.com")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Token refreshed successfully")
     *         )
     *     ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function refresh(Request $request)
    {
        return $this->authService->refresh($request);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/auth/me",
     *     summary="Get authenticated user info",
     *     tags={"Authentication"},
     *     @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string", example="test@example.com"),
     *                 @OA\Property(property="username", type="string", example="test123"),
     *                 @OA\Property(property="email_verified_at", type="string", example="2025-11-20T13:25:27.000000Z"),
     *                 @OA\Property(property="status", type="boolean", example=true),
     *                 @OA\Property(property="mobile", type="boolean", example=false),
     *                 @OA\Property(property="created_at", type="string", example="2025-11-20T13:25:27.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", example="2025-11-20T13:25:27.000000Z"),
     *                 @OA\Property(property="deleted_at", type="string", example="2025-11-20T13:25:27.000000Z"),
     *             ),
     *             @OA\Property(property="message", type="string", example="Success")
     *         )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Authorized",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="data", type="null", example="null"),
     *             @OA\Property(property="message", type="string", example="The token could not be parsed from the request")
     *         )
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function me()
    {
        return $this->authService->me();
    }
}
