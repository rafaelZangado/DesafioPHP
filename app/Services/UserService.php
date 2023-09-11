<?php
// app/Services/UserService.php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $usuarios;

    public function __construct(User $usuarios)
    {
      $this->usuarios = $usuarios;  
    }

    /**
     * Adiciona um novo usuário.
     *
     * @param array $userData
     * @return User
     */
    public function addUser(array $userData): User
    {
        $userData['password'] = Hash::make($userData['password']);
        $user = resolve(User::class);
        $user->fill($userData);
        $user->save();

        return $user;
    }

    /**
     * Edita um usuário existente.
     *
     * @param array $data
     * @return User|null
     */
    public function editUser(array $data): ?User
    {
        $usuario = $this->usuarios->find($data['id']);

        if (!$usuario) {
            return null;
        }

        $usuario->name = $data['name'];
        $usuario->email = $data['email'];
        $usuario->nivel = $data['nivel'];
        $usuario->save();

        return $usuario;
    }

    /**
     * Deleta um usuário.
     *
     * @param int $id
     * @return User
     */
    public function deletarUser(int $id): User
    {
        $user = $this->usuarios->findOrFail($id);
        $user->delete();

        return $user;
    }
}
