<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return response()
            ->json(
                [
                    'success' => true,
                    'data' => $this->userRepository->all()
                ],
                200
            );
    }

    public function findOne(User $user)
    {
        return response()
            ->json(
                [
                    'success' => true,
                    'data' => $this->userRepository->findById($user->id)
                ],
                200
            );
    }

    public function create(CreateUserRequest $requestVal)
    {
        return response()
            ->json(
                [
                    'success' => true,
                    'data' => $this->userRepository->create([
                        'name' => request('name'),
                        'income' => request('income'),
                        'email' => request('email'),
                        'password' => request('password')
                    ])
                ]
            );
    }
}
