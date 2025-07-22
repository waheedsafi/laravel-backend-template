<?php

namespace App\Http\Controllers\v1\auth;

use Sway\Support\JWTTokenGenerator;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function refreshToken()
    {
        return JWTTokenGenerator::refreshToken();
    }
}
