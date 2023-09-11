<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Http\Requests\userRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

     /**
     * Realiza o login do usuário e retorna um token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function loginUser(Request $request): JsonResponse
    {
        $input = $request->all();
        Auth::attempt($input);
        $user = Auth::user();
        $token = $user->createToken('token')->accessToken;
       
        $userPermission = [];

        switch ($user->nivel) {
            case 1:
                $userPermission = ['editar', 'deletar', 'listar', 'cadastrar'];
                break;
            case 2:
                $userPermission = ['editar', 'deletar', 'listar'];
                break;
            case 3:
                $userPermission = ['listar'];
                break;
            // Adicione mais casos conforme necessário para outros níveis.
        }

        return response()->json([
            'status' => 200,
            'nivel de permissao' => $userPermission,
            'token' => $token
        ], 200);
    }

    /**
     * Adiciona um novo usuário.
     *
     * @param userRequest $request
     * @return JsonResponse
     */
    public function addUser(userRequest $request): JsonResponse
    {
        $inputData = $request->validated();
        $user = $this->userService->addUser($inputData);

        return response()->json($user, 201);
    }

    /**
     * Lista todos os usuários.
     *
     * @return JsonResponse
     */
    public function listaUsers(): JsonResponse
    {
        $lista = User::all();
        return response()->json($lista);
    }

    /**
     * Edita um usuário existente.
     *
     * @param EditUserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function edite(EditUserRequest $request, $id): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['id'] = $id;
        $user = $this->userService->editUser($validatedData);

        if (!$user) {
            return response()->json([
                'error' => 'Usuário não encontrado'
            ], 404);
        }

        return response()->json([
            'message' => 'O Usuário foi atualizado com sucesso',
            'data' => $user
        ], 200);
    }

    /**
     * Deleta um usuário.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delet($id): JsonResponse
    {
        $user = $this->userService->deletarUser($id);

        return response()->json([
            'message' => 'O Usuário foi excluído com sucesso',
            'Produto' => $user
        ]);
    }

    /**
     * Realiza o logout do usuário.
     *
     * @return JsonResponse
     */
    public function userLogout(): JsonResponse
    {
        $user = auth('api')->user();

        if ($user) {
            Passport::token()->where('user_id', $user->id)->delete();
            auth('api')->logout();

            return response()->json([
                'message' => 'Usuário deslogado com sucesso',
                'user' => $user
            ], 200);
        }

        return response()->json([
            'message' => 'Usuário não está autenticado'
        ], 401);
    }
}
