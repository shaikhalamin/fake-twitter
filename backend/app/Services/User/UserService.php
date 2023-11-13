<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function list(): Paginator
    {
        return User::orderBy('updated_at', 'desc')->paginate(20);
    }

    public function create(array $data): User
    {
        return User::create([...$data, 'password' => Hash::make($data['password'])]);
    }

    public function show(int $id): User
    {
        $category = User::find($id);

        return $category;
    }

    public function update(array $data, int $id): User
    {
        $user = $this->show($id);
        $user->update($data);

        return $user->refresh();
    }

    public function delete(int $id): bool
    {
        return $this->show($id)->delete();
    }

    public function findByEmail(string $email): User | null
    {
        return User::where('email', $email)->first();
    }
}