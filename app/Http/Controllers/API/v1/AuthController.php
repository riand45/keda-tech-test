<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
       $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        return $this->userRepository->login($request->all());
    }

    public function logout()
    {
        return $this->userRepository->logout();
    }
}
