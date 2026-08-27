<?php

namespace App\Services\Admin;

use App\DTOs\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function __construct() {}

    public function getAll()
    {

        return User::query()
            ->with('roles')
            ->latest()
            ->get([
                'id',
                'name',
                'email',
                'created_at'
            ]);
    }

    public function store(UserData $data)
    {

        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password)
        ]);

        $user->assignRole($data->role);

        return $user;
    }

    public function update(User $user, UserData $data)
    {
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Hash::make($data->password);

        $user->syncRoles($data->role);
        return $user->save();
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
