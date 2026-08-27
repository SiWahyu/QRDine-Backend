<?php

namespace App\DTOs;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $role,
        public string $password
    ) {}

    public static function fromRequest(StoreUserRequest|UpdateUserRequest $request): self
    {
        return new self(
            name: $request->string('name')->toString(),
            email: $request->string('email')->toString(),
            role: $request->string('role')->toString(),
            password: $request->string('password')->toString()
        );
    }
}
