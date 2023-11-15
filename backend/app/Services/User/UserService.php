<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function list()
    {
        return User::orderBy('updated_at', 'desc')->paginate(20);
    }

    public function create(array $data)
    {
        return User::create([...$data, 'password' => Hash::make($data['password'])]);
    }

    public function show(string $id, array $relations = [])
    {
        $category = User::with($relations)->find($id);

        return $category;
    }

    public function update(array $data, string $id)
    {
        $user = $this->show($id);
        $user->update($data);

        return $user->refresh();
    }

    public function delete(string $id): bool
    {
        return $this->show($id)->delete();
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function findByUserName(string $username, array $relations = [])
    {
        return User::with($relations)->where('username', $username)->first();
    }
}
